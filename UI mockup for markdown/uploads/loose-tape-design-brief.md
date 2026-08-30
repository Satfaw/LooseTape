# Loose Tape — design reference brief

## 1. Overview

- **Produk**: sistem reservasi studio musik (web app)
- **User**: admin, staff, penyewa/customer
- **Fungsi inti**: booking studio, manajemen role & akses, cetak data transaksi & rekapitulasi

## 2. Brand & tone

- **Nama**: Loose Tape
- **Kepribadian**: DIY, kasar, analog, sedikit ironis. Namanya hangat (nostalgia kaset/tape), tapi visualnya keras dan blak-blakan — kontras ini yang jadi identitas.
- **Mood reference**: poster gig hardcore/punk era 90an, hasil fotokopi kontras tinggi, artwork label rekaman independen (Dischord Records, Touch and Go Records)

## 3. Color palette

| Peran | Hex | Catatan |
|---|---|---|
| Paper (background utama) | `#F1EFE8` | putih tulang, kesan kertas fotokopi — bukan putih murni |
| Ink (teks utama, garis, border) | `#2C2C2A` | hampir hitam |
| Ink muda (teks sekunder) | `#5F5E5A` | untuk subtitle, metadata |
| Border/divider halus | `#B4B2A9` | garis pemisah, hairline |
| Accent — stamp red (terang) | `#FCEBEB` | background badge/status |
| Accent — stamp red (utama) | `#E24B4A` | CTA utama, garis aksen |
| Accent — stamp red (gelap) | `#501313` | teks di atas background merah terang |

Aturan pakai: merah HANYA untuk elemen penting (CTA utama, status, peringatan). Jangan dipakai dekoratif berlebihan — sisanya tetap monokrom.

## 4. Typography

- **Heading/logo**: bold, uppercase, letter-spacing rapat (kesan stensil/cap). Rekomendasi font: Archivo Black, Anton, atau Oswald Bold.
- **Body text**: sans-serif netral, regular weight, mudah dibaca. Rekomendasi: Inter atau Helvetica.
- **Metadata/kode** (nomor booking, jam, ID): monospace. Rekomendasi: JetBrains Mono atau Courier.

## 5. Aturan komponen UI

- Border tebal solid (2px) untuk section/kartu penting
- Border putus-putus (dashed) untuk elemen bergaya "tiket/struk" (contoh: kartu booking)
- Sudut tajam atau radius kecil (maks 4px) — hindari rounded penuh, biar tidak terkesan app modern glossy
- Badge status dimiringkan sedikit (rotate -5° sampai -8°), meniru cap stempel manual — dipakai untuk status seperti confirmed/pending/cancelled
- Kalau ada foto/ilustrasi, treatment-nya duotone atau halftone kontras tinggi, konsisten dengan nuansa fotokopi

## 6. Halaman yang perlu dibuat

Berdasarkan requirement fitur (CRUD, role & keamanan, cetak laporan):

1. Halaman login
2. Dashboard (tampilan beda per role: admin / staff / customer)
3. Daftar & pencarian booking (tabel data reservasi)
4. Form tambah/edit booking
5. Manajemen data studio (CRUD, admin only)
6. Manajemen user & role (admin only)
7. Detail booking / struk transaksi (siap cetak)
8. Halaman rekap laporan (transaksi per bulan)

## 7. Kata kunci untuk prompt ke Claude Design

> Xerox punk poster aesthetic, off-white paper background, thick black borders, dashed ticket-style cards, bold condensed uppercase headings, monospace metadata text, one red stamp accent color used sparingly, sharp corners, DIY hardcore flyer vibe, high contrast

