<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Loose Tape')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@400;700&family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/loosetape.css') }}">
    @yield('head')
</head>
<body>
    <div class="noise-overlay"></div>
    <div class="scanlines-overlay"></div>

    @auth
    <header class="site-header">
        <div class="site-header-inner">
            <div class="brand">
                <a href="{{ route('dashboard') }}" class="brand-logo glitch-hover">LOOSE TAPE</a>
                <span class="brand-sub">reservation dept.</span>
                <img src="{{ asset('images/tape-sticker.webp') }}" class="brand-sticker" alt="Tape Sticker">
            </div>
            <nav class="nav-links">
                @php $current = Route::currentRouteName(); @endphp
                <a href="{{ route('dashboard') }}" class="nav-btn {{ $current === 'dashboard' ? 'active' : '' }}">DASHBOARD</a>
                <a href="{{ route('bookings.index') }}" class="nav-btn {{ Str::startsWith($current, 'bookings') ? 'active' : '' }}">DAFTAR BOOKING</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-btn">LOGOUT</button>
                </form>
            </nav>
        </div>
    </header>
    @endauth

    @yield('content')

    @auth
    @include('partials.footer')
    @endauth

    @yield('scripts')
    @stack('scripts')
</body>
</html>
