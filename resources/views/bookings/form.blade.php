@extends('layouts.app')

@section('title', ($booking ? 'Edit' : 'Tambah') . ' Booking — Loose Tape')

@section('content')
@include('partials.page-collage')
<div class="page-wrap page-wrap-center" style="overflow:hidden;">


    <div style="width:100%;max-width:560px;position:relative;z-index:1;margin:40px 0;">
        <div class="tape" style="top:-6px;left:260px;transform:rotate(-3deg);"></div>
        <div class="tape" style="top:-6px;right:16px;transform:rotate(4deg);"></div>
        <div class="stamp-label">{{ $booking ? 'EDIT DATA' : 'FORM BARU' }}</div>

        <div class="torn-card">
            <div class="torn-card-shadow"></div>
            <div class="torn-card-body">
                <div style="position:absolute;top:14px;right:18px;width:16px;height:16px;border:2px solid #161514;border-radius:50%;transform:rotate(35deg);z-index:2;">
                    <div style="position:absolute;top:6px;left:-14px;width:26px;height:2px;background:#161514;transform:rotate(-20deg);"></div>
                </div>

                <div class="headline-stamp" style="margin:14px 0 26px;">
                    <span class="shadow-text" style="font-size:22px;letter-spacing:-1px;top:3px;left:4px;opacity:1;">{{ $booking ? 'EDIT BOOKING' : 'TAMBAH BOOKING' }}</span>
                    <span class="main-text" style="font-size:22px;letter-spacing:-1px;color:#161514;transform:rotate(-1.5deg);">{{ $booking ? 'EDIT BOOKING' : 'TAMBAH BOOKING' }}</span>
                </div>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul style="margin:0;padding-left:16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ $booking ? route('bookings.update', $booking) : route('bookings.store') }}" class="form-grid">
                    @csrf
                    @if ($booking)
                        @method('PUT')
                    @endif

                    @if (auth()->user()->hasAnyRole(['admin', 'staff']))
                        <label class="field" style="grid-column:span 2;">
                            <span class="field-label" style="transform:rotate(-1deg);">PENYEWA (USER)</span>
                            <select name="user_id" class="field-select" style="transform:rotate(0.2deg);">
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" @selected(old('user_id', $booking?->user_id) == $u->id)>{{ $u->name }} ({{ $u->email }})</option>
                                @endforeach
                            </select>
                        </label>
                    @endif

                    <label class="field" style="grid-column:span 2;">
                        <span class="field-label" style="transform:rotate(-2deg);">STUDIO</span>
                        <select name="studio_id" class="field-select" style="transform:rotate(0.3deg);">
                            @foreach ($studios as $s)
                                <option value="{{ $s->id }}" @selected(old('studio_id', $booking?->studio_id) == $s->id)>{{ $s->nama_studio }} (Rp {{ number_format($s->harga_per_jam, 0, ',', '.') }}/jam)</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="field">
                        <span class="field-label" style="transform:rotate(2deg);">TANGGAL</span>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $booking?->tanggal?->format('Y-m-d')) }}" @if(auth()->user()->hasRole('customer')) min="{{ now()->toDateString() }}" @endif required class="field-input" style="transform:rotate(-0.3deg);">
                    </label>

                    @if (auth()->user()->hasRole('customer'))
                        {{-- Cinema-style slot picker: shows which hours are free --}}
                        <div style="grid-column:span 2;" id="slot-picker-wrap">
                            <span class="field-label" style="transform:rotate(-1.5deg);">PILIH JAM</span>
                            <div id="slot-grid" class="slot-grid">
                                <div class="slot-empty" id="slot-empty">Pilih studio &amp; tanggal dulu untuk lihat jam kosong.</div>
                            </div>
                            <div class="slot-hint" id="slot-hint">Pilih 1–4 jam berurutan. Slot abu-abu sudah terisi.</div>
                            <input type="hidden" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $booking ? substr($booking->jam_mulai, 0, 5) : '') }}">
                            <input type="hidden" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $booking ? substr($booking->jam_selesai, 0, 5) : '') }}">
                            @if ($booking)
                                <input type="hidden" name="_exclude_slot" value="{{ $booking->id }}">
                            @endif
                        </div>
                    @else
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                            <label class="field">
                                <span class="field-label" style="transform:rotate(-1.5deg);">MULAI</span>
                                <input type="text" name="jam_mulai" value="{{ old('jam_mulai', $booking ? substr($booking->jam_mulai, 0, 5) : '') }}" placeholder="14:00" required class="field-input" style="transform:rotate(0.4deg);">
                            </label>
                            <label class="field">
                                <span class="field-label" style="transform:rotate(1deg);">SELESAI</span>
                                <input type="text" name="jam_selesai" value="{{ old('jam_selesai', $booking ? substr($booking->jam_selesai, 0, 5) : '') }}" placeholder="16:00" required class="field-input" style="transform:rotate(-0.2deg);">
                            </label>
                        </div>
                    @endif

                    <label class="field">
                        <span class="field-label" style="transform:rotate(-1.5deg);">NO. HP</span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $booking?->no_hp) }}" placeholder="0812XXXXXXX" class="field-input" style="transform:rotate(0.3deg);">
                    </label>

                    @if (auth()->user()->hasAnyRole(['admin', 'staff']))
                        <label class="field">
                            <span class="field-label" style="transform:rotate(2deg);">STATUS</span>
                            <select name="status" class="field-select" style="transform:rotate(-0.2deg);">
                                <option value="pending" @selected(old('status', $booking?->status) === 'pending')>PENDING</option>
                                <option value="confirmed" @selected(old('status', $booking?->status) === 'confirmed')>DIKONFIRMASI</option>
                                <option value="cancelled" @selected(old('status', $booking?->status) === 'cancelled')>DIBATALKAN</option>
                            </select>
                        </label>
                    @else
                        <div style="display:none;">
                            <input type="hidden" name="status" value="pending">
                        </div>
                    @endif

                    <label class="field" style="grid-column:span 2;">
                        <span class="field-label" style="transform:rotate(-2deg);">CATATAN</span>
                        <textarea name="catatan" rows="3" placeholder="KEBUTUHAN TAMBAHAN (OPSIONAL)" class="field-textarea" style="transform:rotate(0.2deg);">{{ old('catatan', $booking?->catatan) }}</textarea>
                    </label>

                    <div style="grid-column:span 2;display:flex;align-items:center;gap:14px;margin-top:30px;">
                        <div style="font-family:'Archivo Black',sans-serif;font-size:26px;color:#161514;transform:rotate(-10deg) scaleY(1.3);line-height:1;">&#8595;</div>
                        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;letter-spacing:0.1em;color:#5F5E5A;transform:rotate(-3deg);">SIGN<br>HERE</div>
                        <button type="submit" class="btn-stamp" style="flex:1;">SIMPAN &rarr;</button>
                    </div>

                    <div style="grid-column:span 2;text-align:center;margin-top:14px;">
                        <a href="{{ route('bookings.index') }}" class="btn-ghost">Batal, kembali ke daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if (auth()->user()->hasRole('customer'))
@push('scripts')
<script>
(() => {
    const MAX_SLOTS = 4;
    const grid = document.getElementById('slot-grid');
    const empty = document.getElementById('slot-empty');
    const hint = document.getElementById('slot-hint');
    const fStudio = document.querySelector('select[name=studio_id]');
    const fTanggal = document.querySelector('input[name=tanggal]');
    const hMulai = document.getElementById('jam_mulai');
    const hSelesai = document.getElementById('jam_selesai');
    let slots = [];          // ordered list of {time, taken}
    let selected = [];       // indices into slots

    function toMin(t) { const [h, m] = t.split(':').map(Number); return h * 60 + m; }

    function render() {
        grid.innerHTML = '';
        selected = [];
        slots.forEach((s, i) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'slot-btn' + (s.taken ? ' taken' : '');
            btn.textContent = s.time;
            btn.disabled = s.taken;
            btn.addEventListener('click', () => toggle(i));
            grid.appendChild(btn);
        });
        hMulai.value = hSelesai.value = '';
    }

    function fmtHHMM(min) {
        const h = Math.floor(min / 60), m = min % 60;
        return String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0');
    }

    function updateHiddens() {
        if (!selected.length) { hMulai.value = hSelesai.value = ''; return; }
        const first = slots[selected[0]].time;
        const last = slots[selected[selected.length - 1]].time;
        hMulai.value = first;
        hSelesai.value = toMin(last) + 60 >= 24 * 60 ? '23:59' : fmtHHMM(toMin(last) + 60);
    }

    function toggle(i) {
        if (slots[i].taken) return;
        // contiguous block logic: keep only the block that touches index i
        let start = i, end = i;
        while (start > 0 && !slots[start - 1].taken && selected.includes(start - 1)) start--;
        while (end < slots.length - 1 && !slots[end + 1].taken && selected.includes(end + 1)) end++;
        selected = (i >= start && i <= end) ? [...Array(end - start + 1).keys()].map(k => start + k) : [];
        if (i >= start && i <= end) {
            // limit to MAX_SLOTS: keep the block but clamp from the clicked side
            if (selected.length > MAX_SLOTS) selected = selected.slice(0, MAX_SLOTS);
            // but if the block exceeds max, prefer the segment nearest the click
            if (selected.length > MAX_SLOTS) selected = selected.slice(-MAX_SLOTS);
        }
        grid.querySelectorAll('.slot-btn').forEach((b, idx) => b.classList.toggle('selected', selected.includes(idx)));
        updateHiddens();
    }

    async function loadSlots() {
        if (!fStudio.value || !fTanggal.value) {
            empty.style.display = '';
            empty.textContent = 'Pilih studio & tanggal dulu untuk lihat jam kosong.';
            grid.innerHTML = '';
            return;
        }
        const params = new URLSearchParams({ studio_id: fStudio.value, tanggal: fTanggal.value });
        const exclude = document.querySelector('input[name=_exclude_slot]');
        if (exclude) params.set('exclude', exclude.value);
        const res = await fetch('{{ route("bookings.slots") }}?' + params);
        const data = await res.json();
        slots = Object.entries(data).map(([time, taken]) => ({ time, taken }));
        render();
        // edit mode: pre-select own booking's slots if they're still free
        const initM = hMulai.value, initS = hSelesai.value;
        if (initM && initS) {
            const m = toMin(initM), s = toMin(initS);
            const idxs = [];
            slots.forEach((sl, i) => {
                const t = toMin(sl.time);
                if (t >= m && t < s && !sl.taken) idxs.push(i);
            });
            if (idxs.length) {
                selected = idxs;
                grid.querySelectorAll('.slot-btn').forEach((b, idx) => b.classList.toggle('selected', selected.includes(idx)));
            }
        }
    }

    fStudio.addEventListener('change', loadSlots);
    fTanggal.addEventListener('change', loadSlots);
    if (fStudio.value && fTanggal.value) loadSlots();
})();
</script>
@endpush
@endif
@endsection
