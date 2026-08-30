# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

1. **Customer / Band**: Musisi lokal, band indie, atau penyewa studio yang ingin mencari slot latihan kosong dan melakukan booking langsung.
2. **Staff / Operator**: Penjaga studio yang mengelola operasional harian, memvalidasi jadwal, dan menginput booking offline/manual.
3. **Admin**: Pemilik studio (atau pengembang sistem) yang mengelola studio aktif, hak akses user/role, serta memantau data pendapatan dan transaksi bulanan.

## Product Purpose

Loose Tape adalah platform reservasi studio musik berbasis web yang menyederhanakan proses booking slot latihan band secara online dan real-time. Aplikasi ini bertujuan mencegah bentrok jadwal (double-booking) dan mempercepat administrasi keuangan studio.

## Positioning

Sistem reservasi studio musik berkarakter DIY & hardcore zine/poster gig era 90-an (Xerox punk aesthetic) yang membedakan dirinya secara visual dan vibes dari aplikasi korporat/SaaS modern yang terlampau polos dan steril. Menawarkan kemudahan booking real-time instan tanpa alur telepon/WA manual yang lambat.

## Operating Context

- Digunakan via browser (HP atau Desktop) oleh penyewa ketika sedang di jalan atau saat merencanakan latihan band.
- Digunakan sebagai dashboard kasir/operator di meja admin studio musik.
- Panel manajemen backend admin dikelola via Filament panel di `/admin`.

## Capabilities and Constraints

- **CRUD Booking**: Pelanggan bisa membuat booking baru; Admin & Staff bisa mengedit status (`pending`, `confirmed`, `cancelled`).
- **Autentikasi**: Pembatasan menu navbar dan kontrol CRUD berdasarkan role (Admin, Staff, Customer).
- **Auto Transaksi**: Setiap booking baru otomatis membuat record transaksi tagihan (status `belum_bayar`).
- **Desain Khusus**: Menggunakan framework CSS vanilla kustom yang dimodifikasi agar menyerupai poster fotokopian bertema punk.

## Brand Commitments

- **Nama**: Loose Tape (reservation dept.)
- **Tema Visual**: Xerox punk poster, off-white background (`#F1EFE8`), border hitam tebal, tiket sobek-sobek (clip-path), font stensil/archivo, stamp red accent (`#FF1F8F` neon pink).
- **Voice/Tone**: Kasar, analog, DIY, blak-blakan, tidak formal.

## Evidence on Hand

- Aplikasi adalah prototype/demo fungsional dengan data dummy (Studio A, Studio B, Studio C). Tidak ada studio fisik asli yang terhubung secara riil.

## Product Principles

1. **Jelas Tanpa Antrean**: Jadwal harus real-time, terlihat jelas slot yang terisi dan kosong, tidak boleh ada overlap.
2. **Karakter Kuat (DIY)**: Menolak desain visual steril. Tampilan kasar fotokopi adalah identitas utama Loose Tape.
3. **Fokus pada Tugas**: Mempermudah pemesanan slot latihan secepat mungkin dengan input minimum.
