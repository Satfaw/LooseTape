@extends('layouts.app')

@section('title', 'Dashboard — Loose Tape')

@section('content')
<div class="page-wrap">
    <div class="dashboard-texture"></div>
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    <img src="{{ asset('images/star-sticker.webp') }}" class="sticker-hover hide-mobile" style="position:absolute;top:8px;right:0;width:56px;height:auto;mix-blend-mode:screen;opacity:0.85;transform:rotate(10deg);z-index:0;--r:10deg;" alt="">
    <img src="{{ asset('images/anarchy-sticker.webp') }}" class="sticker-hover hide-mobile" style="position:absolute;bottom:24px;left:-8px;width:48px;height:auto;mix-blend-mode:screen;opacity:0.8;transform:rotate(-12deg);z-index:0;--r:-12deg;" alt="">

    <div class="page-header">
        <div>
            <div class="headline-stamp" style="margin-bottom:6px;">
                <span class="shadow-text" style="font-size:34px;letter-spacing:-1px;transform:rotate(-4deg);">DASHBOARD</span>
                <span class="main-text" style="font-size:34px;letter-spacing:-1px;color:#F1EFE8;transform:rotate(2deg);">DASHBOARD</span>
            </div>
            <div class="page-sub">Halo, {{ auth()->user()->name }} — kamu login sebagai <strong style="color:#FF1F8F;text-transform:uppercase;">{{ $role }}</strong>.</div>
        </div>
    </div>

    @if ($role === 'admin')
        <div class="stat-grid">
            <div class="stat-card" style="transform:rotate(-1.5deg);">
                <div class="tape" style="top:-8px;left:18px;width:44px;height:14px;transform:rotate(-4deg);"></div>
                <div class="stat-card-shadow"></div>
                <div class="stat-card-body">
                    <div class="stat-label">BOOKING BULAN INI</div>
                    <div class="stat-value">{{ $stats['bookingBulanIni'] }}</div>
                </div>
            </div>
            <div class="stat-card" style="transform:rotate(1deg);">
                <div class="tape" style="top:-8px;right:24px;width:44px;height:14px;transform:rotate(3deg);"></div>
                <div class="stat-card-shadow"></div>
                <div class="stat-card-body">
                    <div class="stat-label">STUDIO AKTIF</div>
                    <div class="stat-value">{{ $stats['studioAktif'] }}</div>
                </div>
            </div>
            <div class="stat-card" style="transform:rotate(-1deg);">
                <div class="tape" style="top:-8px;left:50%;width:44px;height:14px;transform:translateX(-50%) rotate(-2deg);"></div>
                <div class="stat-card-shadow pink"></div>
                <div class="stat-card-body">
                    <div class="stat-label accent">PENDAPATAN BULAN INI</div>
                    <div class="stat-value accent">Rp {{ number_format($stats['pendapatanBulanIni'], 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="barcode-strip">
            @foreach ([35,70,20,90,45,60,15,80,50,95,25,65,40,85,30,75,55,10,88,42,68,22,78,48,92,33,58,18] as $i => $h)
                <div style="height:{{ $h }}%;" class="{{ in_array($i, [1,4,7,10,13,16,19,22,25]) ? 'pink' : '' }}"></div>
            @endforeach
        </div>

        <div style="display:flex;gap:16px;margin-bottom:32px;position:relative;flex-wrap:wrap;">
            <div class="tape" style="top:-8px;left:60px;width:44px;height:14px;transform:rotate(-3deg);"></div>
            <a href="{{ url('/admin/studios') }}" class="dashed-box" style="flex:1;text-decoration:none;">Manajemen Data Studio <span style="color:#8A887F;">— buka panel admin</span></a>
            <a href="{{ url('/admin') }}" class="dashed-box" style="flex:1;text-decoration:none;">Manajemen User &amp; Role <span style="color:#8A887F;">— buka panel admin</span></a>
        </div>
    @elseif ($role === 'staff')
        <div class="solid-box" style="margin-bottom:24px;">
            <div style="font-size:13px;color:#B4B2A9;">Jadwal hari ini: <span style="color:#F1EFE8;font-weight:600;">{{ $bookings->count() }} booking</span></div>
            <a href="{{ route('bookings.create') }}" class="btn-pink" style="font-size:12px;padding:8px 14px;">+ TAMBAH BOOKING</a>
        </div>
    @else
        <div class="pink-dashed-box" style="margin-bottom:24px;">
            <div>
                <div style="font-family:'Archivo Black',sans-serif;font-size:16px;">MAU NGE-JAM?</div>
                <div style="font-size:13px;color:#B8B5AC;margin-top:2px;">Booking studio baru dalam hitungan menit.</div>
            </div>
            <a href="{{ route('bookings.create') }}" class="btn-pink" style="font-size:13px;padding:10px 18px;">BOOKING BARU</a>
        </div>
    @endif

    <div class="section-tag">{{ $listLabel }}</div>
    <div class="torn-card torn-card-flat">
        <div class="tape" style="top:-8px;right:40px;width:44px;height:14px;transform:rotate(4deg);"></div>
        <div class="torn-card-shadow"></div>
        <div class="torn-card-body ticket-list">
            @forelse ($bookings as $b)
                <div class="ticket-row">
                    <div style="display:flex;flex-direction:column;gap:2px;">
                        <div class="ticket-id">BKG-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</div>
                        <div class="ticket-title">{{ $b->studio->nama_studio }} &middot; {{ $b->user->name }}</div>
                        <div class="ticket-meta">{{ $b->tanggal->translatedFormat('d M Y') }}, {{ substr($b->jam_mulai, 0, 5) }}&ndash;{{ substr($b->jam_selesai, 0, 5) }}</div>
                    </div>
                    @php
                        $badgeClass = ['confirmed' => 'badge-confirmed', 'pending' => 'badge-pending', 'cancelled' => 'badge-cancelled'][$b->status];
                        $badgeLabel = ['confirmed' => 'DIKONFIRMASI', 'pending' => 'PENDING', 'cancelled' => 'DIBATALKAN'][$b->status];
                    @endphp
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="badge {{ $badgeClass }}">{{ $badgeLabel }}</div>
                        @if ($b->status === 'pending' && ($role !== 'customer' || $b->user_id === auth()->id()))
                            <form method="POST" action="{{ route('bookings.cancel', $b) }}" onsubmit="return confirm('Yakin mau batalin booking BKG-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }} ({{ $b->studio->nama_studio }}, {{ $b->tanggal->translatedFormat('d M') }} {{ substr($b->jam_mulai, 0, 5) }})?');" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-ghost" style="font-size:10px;padding:5px 10px;color:#FF1F8F;border-color:#FF1F8F;cursor:pointer;background:none;">BATALKAN</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="ticket-row"><div class="ticket-meta">Belum ada booking.</div></div>
            @endforelse
        </div>
    </div>
</div>
@endsection
