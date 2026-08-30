@extends('layouts.app')

@section('title', 'Daftar Booking — Loose Tape')

@section('content')
@include('partials.page-collage')
<div class="page-wrap">
    <div style="position:absolute;top:0px;right:145px;font-family:'Archivo Black',sans-serif;font-size:46px;line-height:1;color:#FF1F8F;-webkit-text-stroke:2px #161514;transform:rotate(8deg);z-index:2;--r:8deg;" class="sticker-hover">!</div>

    <div class="page-header">
        <div>
            <div class="headline-stamp" style="margin-bottom:6px;">
                <span class="shadow-text" style="font-size:34px;letter-spacing:-1px;transform:rotate(3deg);">DAFTAR BOOKING</span>
                <span class="main-text" style="font-size:34px;letter-spacing:-1px;color:#F1EFE8;transform:rotate(-2deg);">DAFTAR BOOKING</span>
            </div>
            <div class="page-sub">Semua reservasi studio.</div>
        </div>
        <a href="{{ route('bookings.create') }}" class="btn-pink" style="font-size:13px;padding:10px 18px;">+ BOOKING BARU</a>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('bookings.index') }}" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, studio, atau ID..." class="search-input">
        <select name="status" class="search-select" onchange="this.form.submit()">
            <option value="">Semua status</option>
            <option value="confirmed" @selected(request('status') === 'confirmed')>Dikonfirmasi</option>
            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>Dibatalkan</option>
        </select>
        <button type="submit" class="btn-pink" style="font-size:12px;padding:10px 16px;">CARI</button>
    </form>

    <div class="table-wrap">
        <div class="table-shadow"></div>
        <div class="table-body">
            <div class="table-noise"></div>
            <div class="table-head">
                <div>ID</div><div class="hide-mobile">STUDIO</div><div>CUSTOMER</div><div class="hide-mobile">TANGGAL</div><div class="hide-mobile">JAM</div><div class="hide-mobile">STATUS</div><div>AKSI</div>
            </div>
            @forelse ($bookings as $b)
                @php
                    $badgeClass = ['confirmed' => 'badge-confirmed', 'pending' => 'badge-pending', 'cancelled' => 'badge-cancelled'][$b->status];
                    $badgeLabel = ['confirmed' => 'DIKONFIRMASI', 'pending' => 'PENDING', 'cancelled' => 'DIBATALKAN'][$b->status];
                @endphp
                <div class="table-row">
                    <div class="table-cell-id">BKG-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }}</div>
                    <div class="table-cell-studio hide-mobile">{{ $b->studio->nama_studio }}</div>
                    <div class="table-cell-name">{{ $b->user->name }}</div>
                    <div class="table-cell-muted hide-mobile">{{ $b->tanggal->translatedFormat('d M Y') }}</div>
                    <div class="table-cell-mono hide-mobile">{{ substr($b->jam_mulai, 0, 5) }}&ndash;{{ substr($b->jam_selesai, 0, 5) }}</div>
                    <div class="hide-mobile"><span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span></div>
                    <div style="display:flex;gap:8px;">
                        @if ($b->status === 'pending')
                            <form method="POST" action="{{ route('bookings.approve', $b) }}" onsubmit="return confirm('Approve booking BKG-{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }} ({{ $b->studio->nama_studio }}, {{ $b->tanggal->translatedFormat('d M') }} {{ substr($b->jam_mulai, 0, 5) }})?');" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-pink" style="font-size:12px;padding:8px 14px;cursor:pointer;">Approve</button>
                            </form>
                        @endif
                        <a href="{{ route('bookings.edit', $b) }}" class="btn-outline">Edit</a>
                    </div>
                </div>
            @empty
                <div class="table-row" style="grid-template-columns:1fr;"><div class="table-cell-muted">Tidak ada booking ditemukan.</div></div>
            @endforelse
        </div>
    </div>
</div>
@endsection
