<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Studio;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first() ?? 'customer';

        $query = Booking::with(['studio', 'user']);

        if ($role === 'staff') {
            $query->whereDate('tanggal', now()->toDateString());
        } elseif ($role === 'customer') {
            $query->where('user_id', $user->id);
        }

        $bookings = $query->latest('tanggal')->take(5)->get();

        $stats = [];
        if ($role === 'admin') {
            $stats = [
                'bookingBulanIni' => Booking::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count(),
                'studioAktif' => Studio::where('status', 'aktif')->count(),
                'pendapatanBulanIni' => Transaksi::where('status_bayar', 'lunas')
                    ->whereMonth('tanggal_bayar', now()->month)
                    ->whereYear('tanggal_bayar', now()->year)
                    ->sum('jumlah_bayar'),
            ];
        }

        $listLabel = match ($role) {
            'staff' => 'JADWAL HARI INI',
            'customer' => 'BOOKING SAYA',
            default => 'BOOKING TERBARU',
        };

        return view('dashboard', [
            'role' => $role,
            'bookings' => $bookings,
            'stats' => $stats,
            'listLabel' => $listLabel,
        ]);
    }
}
