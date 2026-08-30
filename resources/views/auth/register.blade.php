@extends('layouts.app')

@section('title', 'Daftar — Loose Tape')

@section('content')
@include('partials.page-collage')
<div class="page-wrap page-wrap-center" style="min-height:100vh;overflow:hidden;">

    <div style="width:100%;max-width:420px;position:relative;z-index:1;">
        {{-- SIDE A sticker --}}
        <div class="sticker-hover" style="position:absolute;bottom:-40px;right:-46px;width:96px;transform:rotate(-8deg);z-index:4;--r:-8deg;">
            <div style="background:#161514;border:2px solid #F1EFE8;padding:10px 8px;clip-path:polygon(0 6%,100% 0,100% 94%,0 100%);box-shadow:4px 5px 0 rgba(0,0,0,0.35);">
                <div style="font-family:'Archivo Black',sans-serif;font-size:15px;color:#FF1F8F;line-height:1;text-align:center;">SIDE<br>A</div>
            </div>
        </div>
        <div class="tape" style="top:-6px;left:190px;transform:rotate(-3deg);"></div>
        <div class="tape" style="top:-6px;right:16px;transform:rotate(4deg);"></div>
        <div class="stamp-label">BUAT AKUN</div>

        <div class="torn-card">
            <div class="torn-card-shadow"></div>
            <div class="torn-card-body">
                <div class="headline-stamp" style="margin:12px 0 8px;">
                    <span class="shadow-text" style="font-size:30px;letter-spacing:-1px;top:3px;left:4px;opacity:1;">DAFTAR</span>
                    <span class="main-text" style="font-size:30px;letter-spacing:-1px;color:#161514;transform:rotate(-1.5deg);">DAFTAR</span>
                </div>
                <div style="font-size:13px;color:#5F5E5A;margin-bottom:28px;">Buat akun baru untuk reservasi studio.</div>

                @if ($errors->any())
                    <div class="alert-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" style="display:flex;flex-direction:column;gap:16px;">
                    @csrf
                    <label style="display:flex;flex-direction:column;gap:6px;">
                        <span style="font-family:'Archivo Black',sans-serif;font-size:11px;letter-spacing:0.03em;color:#5F5E5A;">NAMA LENGKAP</span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="CTH. RANI PUSPITA" required
                            style="border:2px solid #2C2C2A;background-color:#F1EFE8;background-image:radial-gradient(rgba(44,44,42,0.25) 0.6px, transparent 0.7px);background-size:5px 5px;padding:10px 12px;font-size:14px;font-family:'Archivo Black',sans-serif;color:#2C2C2A;border-radius:2px;text-transform:uppercase;">
                    </label>
                    <label style="display:flex;flex-direction:column;gap:6px;">
                        <span style="font-family:'Archivo Black',sans-serif;font-size:11px;letter-spacing:0.03em;color:#5F5E5A;">EMAIL</span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="CTH. NAMA@EMAIL.COM" required
                            style="border:2px solid #2C2C2A;background-color:#F1EFE8;background-image:radial-gradient(rgba(44,44,42,0.25) 0.6px, transparent 0.7px);background-size:5px 5px;padding:10px 12px;font-size:14px;font-family:'Archivo Black',sans-serif;color:#2C2C2A;border-radius:2px;text-transform:uppercase;">
                    </label>
                    <label style="display:flex;flex-direction:column;gap:6px;">
                        <span style="font-family:'Archivo Black',sans-serif;font-size:11px;letter-spacing:0.03em;color:#5F5E5A;">PASSWORD</span>
                        <input type="password" name="password" placeholder="••••••••" required
                            style="border:2px solid #2C2C2A;background-color:#F1EFE8;background-image:radial-gradient(rgba(44,44,42,0.25) 0.6px, transparent 0.7px);background-size:5px 5px;padding:10px 12px;font-size:14px;color:#2C2C2A;border-radius:2px;">
                    </label>
                    <label style="display:flex;flex-direction:column;gap:6px;">
                        <span style="font-family:'Archivo Black',sans-serif;font-size:11px;letter-spacing:0.03em;color:#5F5E5A;">KONFIRMASI PASSWORD</span>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required
                            style="border:2px solid #2C2C2A;background-color:#F1EFE8;background-image:radial-gradient(rgba(44,44,42,0.25) 0.6px, transparent 0.7px);background-size:5px 5px;padding:10px 12px;font-size:14px;color:#2C2C2A;border-radius:2px;">
                    </label>
                    <button type="submit" class="btn-pink" style="margin-top:8px;font-size:14px;padding:12px;width:100%;">DAFTAR &rarr;</button>
                    <div style="text-align:center;font-size:12px;color:#5F5E5A;">Sudah punya akun? <a href="{{ route('login') }}" style="color:#FF1F8F;text-decoration:underline;font-weight:bold;">Masuk di sini</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
