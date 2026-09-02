<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Studio;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /** Open hours: first slot starts at 10:00, last slot 21:00 (booking until 22:00). */
    const SLOT_MULAI = 10;
    const SLOT_SELESAI = 22;

    /**
     * Slot availability for a studio+tanggal. Used by the form's slot grid.
     * Returns map: { "10:00": false, "11:00": true, ... } (true = taken).
     * Cancelled bookings never block; $excludeId skips the booking being edited.
     */
    public function slots(Request $request)
    {
        $data = $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'tanggal' => 'required|date',
            'exclude' => 'nullable|integer',
        ]);

        $taken = collect([]);
        $bookings = Booking::where('studio_id', $data['studio_id'])
            ->whereDate('tanggal', $data['tanggal'])
            ->whereIn('status', ['pending', 'confirmed']);
        if (isset($data['exclude'])) {
            $bookings->where('id', '!=', $data['exclude']);
        }
        $bookings->get(['jam_mulai', 'jam_selesai'])
            ->each(function ($b) use (&$taken) {
                $start = (int) substr($b->jam_mulai, 0, 2);
                $end = (int) substr($b->jam_selesai, 0, 2);
                for ($h = $start; $h < $end; $h++) {
                    $taken->push(sprintf('%02d:00', $h));
                }
            });

        $slots = [];
        for ($h = self::SLOT_MULAI; $h < self::SLOT_SELESAI; $h++) {
            $key = sprintf('%02d:00', $h);
            $slots[$key] = $taken->contains($key);
        }

        return response()->json($slots);
    }

    /** Reject bookings overlapping an existing pending/confirmed one for the same studio+tanggal. */
    private function ensureNoOverlap(array $validated, ?int $excludeId = null): void
    {
        $overlap = Booking::where('studio_id', $validated['studio_id'])
            ->whereDate('tanggal', $validated['tanggal'])
            ->whereIn('status', ['pending', 'confirmed']);
        if ($excludeId) {
            $overlap->where('id', '!=', $excludeId);
        }
        $exists = $overlap->where(function ($q) use ($validated) {
            $q->where('jam_mulai', '<', $validated['jam_selesai'])
                ->where('jam_selesai', '>', $validated['jam_mulai']);
        })->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'jam_mulai' => 'Jam tersebut sudah dibooking. Silakan pilih jam lain.',
            ]);
        }
    }

    /** Duration in hours between two HH:MM strings (e.g. 14:00–16:00 => 2). */
    private static function durasiJam(string $mulai, string $selesai): int
    {
        return max(1, (int) substr($selesai, 0, 2) - (int) substr($mulai, 0, 2));
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first() ?? 'customer';

        // customers go straight to the add-booking form; the list page is admin/staff only
        if ($role === 'customer') {
            return redirect()->route('bookings.create');
        }

        $query = Booking::with(['studio', 'user']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('studio', function ($qs) use ($search) {
                        $qs->where('nama_studio', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $bookings = $query->latest('id')->get();

        return view('bookings.index', [
            'bookings' => $bookings,
            'role' => $role,
        ]);
    }

    public function create()
    {
        if (Auth::user()->hasAnyRole(['admin', 'staff'])) {
            return redirect()->route('bookings.index');
        }

        $studios = Studio::where('status', 'aktif')->get();
        $users = User::all();
        return view('bookings.form', [
            'booking' => null,
            'studios' => $studios,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'studio_id' => 'required|exists:studios,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'no_hp' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
        ];

        if (Auth::user()->hasAnyRole(['admin', 'staff'])) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        } else {
            // customers cannot book past dates
            $rules['tanggal'] = 'required|date|after_or_equal:today';
        }

        $validated = $request->validate($rules, [
            'tanggal.after_or_equal' => 'Tanggal tidak valid — tidak bisa booking di hari yang sudah lewat.',
        ]);

        if (!Auth::user()->hasAnyRole(['admin', 'staff'])) {
            $validated['user_id'] = Auth::id();
            $validated['status'] = 'pending';
        }

        $this->ensureNoOverlap($validated);

        $booking = Booking::create($validated);

        // Auto create transaksi default
        $studio = Studio::find($validated['studio_id']);
        Transaksi::create([
            'booking_id' => $booking->id,
            'jumlah_bayar' => $studio->harga_per_jam * self::durasiJam($validated['jam_mulai'], $validated['jam_selesai']),
            'metode_bayar' => 'tunai',
            'status_bayar' => 'belum_bayar',
        ]);

        // customers land on dashboard (shows their bookings); admin/staff back to the list
        $target = Auth::user()->hasAnyRole(['admin', 'staff']) ? 'bookings.index' : 'dashboard';
        return redirect()->route($target)->with('success', 'Booking berhasil dibuat.');
    }

    public function edit(Booking $booking)
    {
        $user = Auth::user();
        if ($user->hasRole('customer') && $booking->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $studios = Studio::where('status', 'aktif')->get();
        $users = User::all();

        return view('bookings.form', [
            'booking' => $booking,
            'studios' => $studios,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $user = Auth::user();
        if ($user->hasRole('customer') && $booking->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $rules = [
            'studio_id' => 'required|exists:studios,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'no_hp' => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
        ];

        if ($user->hasAnyRole(['admin', 'staff'])) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        } else {
            $rules['tanggal'] = 'required|date|after_or_equal:today';
        }

        $validated = $request->validate($rules, [
            'tanggal.after_or_equal' => 'Tanggal tidak valid — tidak bisa booking di hari yang sudah lewat.',
        ]);

        $this->ensureNoOverlap($validated, $booking->id);

        $booking->update($validated);

        $target = $user->hasAnyRole(['admin', 'staff']) ? 'bookings.index' : 'dashboard';
        return redirect()->route($target)->with('success', 'Booking berhasil diperbarui.');
    }

    public function approve(Booking $booking)
    {
        $user = Auth::user();

        if (!$user->hasAnyRole(['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking berstatus pending yang bisa di-approve.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking berhasil di-approve.');
    }

    public function cancel(Booking $booking)
    {
        $user = Auth::user();

        // customers may only cancel their own bookings; admin/staff cancel anything
        if ($user->hasRole('customer') && $booking->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking ini sudah dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        $target = $user->hasAnyRole(['admin', 'staff']) ? 'bookings.index' : 'dashboard';
        return redirect()->route($target)->with('success', 'Booking berhasil dibatalkan.');
    }
}
