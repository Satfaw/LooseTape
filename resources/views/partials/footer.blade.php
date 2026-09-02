{{-- Loose Tape — Site Footer --}}
<footer class="site-footer">

    {{-- torn top edge --}}
    <div class="footer-tear"></div>

    <div class="footer-inner">

        {{-- ── COL 1 · Brand --}}
        <div class="footer-col footer-col--brand">
            <a href="{{ route('dashboard') }}" class="footer-brand glitch-hover">LOOSE TAPE</a>
            <span class="footer-brand-sub">reservation dept.</span>
            <p class="footer-tagline">
                Sewa studio latihan band dengan sistem reservasi online.
                Pilih jadwal, konfirmasi, dan langsung jam.
            </p>

            {{-- Social icons (SVG inline, no emoji) --}}
            <div class="footer-socials">
                {{-- Instagram --}}
                <a href="https://instagram.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
                {{-- YouTube --}}
                <a href="https://youtube.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="YouTube">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
                {{-- Twitter / X --}}
                <a href="https://x.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Twitter / X">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                    </svg>
                </a>
                {{-- Facebook --}}
                <a href="https://facebook.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- ── COL 2 · Quick Links --}}
        <div class="footer-col">
            <div class="footer-col-heading">
                <span class="footer-col-heading-text">NAVIGASI</span>
            </div>
            <nav class="footer-nav">
                @auth
                    @php $cur = Route::currentRouteName(); @endphp
                    <a href="{{ route('dashboard') }}" class="footer-nav-link {{ $cur === 'dashboard' ? 'active' : '' }}">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><rect width="4" height="4"/><rect x="6" width="4" height="4"/><rect y="6" width="4" height="4"/><rect x="6" y="6" width="4" height="4"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('bookings.index') }}" class="footer-nav-link {{ Str::startsWith($cur, 'bookings') ? 'active' : '' }}">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><rect width="4" height="4"/><rect x="6" width="4" height="4"/><rect y="6" width="4" height="4"/><rect x="6" y="6" width="4" height="4"/></svg>
                        Daftar Booking
                    </a>
                    @if (auth()->user()->hasRole('customer'))
                        <a href="{{ route('bookings.create') }}" class="footer-nav-link">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><rect width="4" height="4"/><rect x="6" width="4" height="4"/><rect y="6" width="4" height="4"/><rect x="6" y="6" width="4" height="4"/></svg>
                            Booking Baru
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="footer-nav-link footer-nav-link--btn">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><rect width="4" height="4"/><rect x="6" width="4" height="4"/><rect y="6" width="4" height="4"/><rect x="6" y="6" width="4" height="4"/></svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="footer-nav-link">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><rect width="4" height="4"/><rect x="6" width="4" height="4"/><rect y="6" width="4" height="4"/><rect x="6" y="6" width="4" height="4"/></svg>
                        Login
                    </a>
                @endauth
            </nav>
        </div>

        {{-- ── COL 3 · Contact --}}
        <div class="footer-col">
            <div class="footer-col-heading">
                <span class="footer-col-heading-text">HUBUNGI KAMI</span>
            </div>
            <ul class="footer-contact">
                <li>
                    <span class="footer-contact-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <a href="mailto:satriofawwas096@gmail.com" class="footer-contact-link">satriofawwas096@gmail.com</a>
                </li>
                <li>
                    <span class="footer-contact-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.38 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.79 16a2 2 0 0 1 .21.92z"/>
                        </svg>
                    </span>
                    <a href="https://wa.me/6287785273950" target="_blank" rel="noopener" class="footer-contact-link">+62 877-8527-3950</a>
                </li>
                <li>
                    <span class="footer-contact-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </span>
                    <span class="footer-contact-text">Edelweiss Town House,<br>Kota, Provinsi</span>
                </li>
            </ul>
        </div>

    </div>

    {{-- ── Bottom bar --}}
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <div class="footer-bottom-left">
                <span class="footer-copy">
                    &copy; 2026 <strong>LOOSE TAPE</strong>. Hak Cipta Dilindungi Undang-Undang.
                </span>
            </div>
            <div class="footer-bottom-right">
                <a href="#" class="footer-legal-link">Kebijakan Privasi</a>
                <span class="footer-legal-sep">/</span>
                <a href="#" class="footer-legal-link">Syarat &amp; Ketentuan</a>
                <span class="footer-legal-sep">/</span>
                <a href="#" class="footer-legal-link">Disclaimer</a>
            </div>
        </div>
    </div>

</footer>
