---
name: Loose Tape
description: Sistem reservasi studio musik dengan estetika xerox punk zine DIY era 90-an.
colors:
  stamp-pink: "#FF1F8F"
  void-black: "#0A0A09"
  ink-dark: "#161514"
  ink: "#2C2C2A"
  ink-light: "#5F5E5A"
  xerox-paper: "#F1EFE8"
  pure-white: "#FFFFFF"
  border-soft: "#B4B2A9"
  muted-warm: "#9B9890"
  muted-warm-2: "#8A887F"
typography:
  display:
    fontFamily: "Archivo Black, sans-serif"
    fontSize: "34px"
    fontWeight: 400
    letterSpacing: "-1px"
  headline:
    fontFamily: "Archivo Black, sans-serif"
    fontSize: "22px"
    fontWeight: 400
    letterSpacing: "-1px"
  body:
    fontFamily: "Inter, sans-serif"
    fontSize: "13px"
    fontWeight: 400
  label:
    fontFamily: "Archivo Black, sans-serif"
    fontSize: "10px"
    letterSpacing: "0.02em"
  mono:
    fontFamily: "JetBrains Mono, monospace"
    fontSize: "11px"
    fontWeight: 700
    letterSpacing: "0.06em"
  accent:
    fontFamily: "UnifrakturCook, cursive"
    fontSize: "15px"
    fontWeight: 700
  caption:
    fontFamily: "Inter, sans-serif"
    fontSize: "12px"
    fontWeight: 400
  small:
    fontFamily: "Inter, sans-serif"
    fontSize: "14px"
    fontWeight: 400
  subhead:
    fontFamily: "Archivo Black, sans-serif"
    fontSize: "16px"
    fontWeight: 400
  jumbo:
    fontFamily: "Archivo Black, sans-serif"
    fontSize: "46px"
    fontWeight: 400
    letterSpacing: "-1px"
rounded:
  none: "0px"
  subtle: "2px"
spacing:
  xs: "8px"
  sm: "12px"
  md: "16px"
  lg: "20px"
  xl: "32px"
  xxl: "40px"
components:
  button-stamp:
    backgroundColor: "{colors.stamp-pink}"
    textColor: "{colors.ink-dark}"
    rounded: "{rounded.none}"
    padding: "20px"
  button-pink:
    backgroundColor: "{colors.stamp-pink}"
    textColor: "{colors.xerox-paper}"
    rounded: "{rounded.subtle}"
    padding: "10px 18px"
  badge-confirmed:
    backgroundColor: "{colors.stamp-pink}"
    textColor: "{colors.xerox-paper}"
    rounded: "{rounded.subtle}"
    padding: "3px 9px"
  badge-pending:
    backgroundColor: "{colors.ink-dark}"
    textColor: "{colors.stamp-pink}"
    rounded: "{rounded.subtle}"
    padding: "3px 9px"
  field-input:
    backgroundColor: "{colors.xerox-paper}"
    textColor: "{colors.ink-dark}"
    rounded: "{rounded.none}"
    padding: "11px 10px"
---

# Design System: Loose Tape

## Overview

**Creative North Star: "The Gigs Xerox Zine"**

Loose Tape tampil seperti poster gig hardcore/punk era 90-an yang difotokopi berulang kali: kasar, kontras tinggi, dan blak-blakan. Latar hitam pekat (`#0A0A09`) berfungsi sebagai meja gelap tempat "potongan kertas" putih ditempel — setiap kartu punya tepi sobekan (clip-path), selotip di sudutnya, dan stempel miring. Aksen neon pink (`#FF1F8F`) dipakai seperti tinta stempel: mencolok, disengaja, dan hanya untuk hal penting.

Sistem ini menolak kehalusan SaaS modern. Tidak ada gradient lembut, tidak ada rounded corner besar, tidak ada bayangan realistis. Kedalaman datang dari kontras warna keras, offset "cetakan meleset" (double-print), dan rotasi elemen 1–8 derajat yang meniru tempelan tangan.

**Key Characteristics:**
- Kolase poster xerox high-contrast sebagai background halaman
- Kartu putih dengan tepi sobek + bayangan offset solid (bukan blur)
- Stempel miring (rotate -6°) untuk badge status
- Noise/grain + scanline overlay di seluruh viewport
- Animasi glitch pada hover, stickerjolt untuk stiker

## Colors

Palet monokrom fotokopi dengan satu tinta stempel neon.

### Primary
- **Stamp Pink** (#FF1F8F): Tinta stempel neon. CTA utama, border aksen, badge DIKONFIRMASI, header tabel, text-shadow logo. Dipakai hemat tapi berani.

### Neutral
- **Void Black** (#0A0A09): Background halaman utama — meja gelap tempat kolase ditempel.
- **Ink Dark** (#161514): Header bar, stempel label, tombol nav aktif.
- **Ink** (#2C2C2A): Border tebal komponen, bayangan offset kartu, teks utama di atas putih.
- **Ink Light** (#5F5E5A): Teks sekunder/metadata di atas kertas putih.
- **Xerox Paper** (#F1EFE8): Putih tulang kertas fotokopi — background input dan teks di atas gelap.
- **Pure White** (#FFFFFF): Isi kartu sobek.
- **Border Soft** (#B4B2A9): Divider hairline antar baris tiket.
- **Muted Warm** (#9B9890): Subtitle di atas background gelap.

### Named Rules
**The Stamp Ink Rule.** Pink #FF1F8F hanya untuk elemen penting: CTA, status, aksen header. Jangan dipakai dekoratif merata — kelangkaannya adalah kekuatannya.

## Typography

**Display Font:** Archivo Black (sans-serif)
**Body Font:** Inter (sans-serif)
**Label/Mono Font:** JetBrains Mono (monospace); UnifrakturCook (cursive) khusus tagline "reservation dept."

**Character:** Stensil poster yang keras dan padat, diseimbangkan body text netral yang mudah dibaca, dengan metadata monospace bergaya tiket/struk.

### Hierarchy
- **Display** (400, 34px, letter-spacing -1px): Judul halaman (DASHBOARD, DAFTAR BOOKING). Selalu dengan efek double-print: duplikat pink offset di belakang teks utama, keduanya sedikit dirotasi berlawanan.
- **Headline** (400, 22–30px): Judul kartu/form (MASUK, TAMBAH BOOKING). Efek double-print sama.
- **Body** (400, 13–14px, Inter): Teks paragraf, deskripsi, isi tabel.
- **Label** (400, 10–11px, Archivo Black, uppercase): Label field form — ditampilkan sebagai pita hitam kecil menimpa border input.
- **Mono** (700, 10–12px, letter-spacing 0.06–0.08em): ID booking (BKG-0001), jam, header tabel, badge status.

### Named Rules
**The Double-Print Rule.** Setiap judul besar dicetak dua kali: bayangan pink offset 3–6px di belakang, teks utama di depan dengan rotasi ±2°. Meniru cetakan sablon yang meleset.

## Layout

Kontainer maksimum 1240px, padding horizontal 40px. Halaman form dan login dipusatkan dengan lebar kartu 420–560px. Grid stat 3 kolom (collapse ke 1 kolom < 720px). Tabel booking pakai CSS grid dengan kolom tetap. Elemen dekoratif (stiker, tanda seru, selotip) diposisikan absolute menimpa grid — kesengajaan "tempelan tangan" yang keluar dari alignment.

## Elevation & Depth

Tidak ada box-shadow blur realistis. Kedalaman dibangun dari: (1) bayangan offset solid — duplikat bentuk kartu digeser 3–6px berwarna `#2C2C2A` atau pink; (2) kontras keras hitam/putih/pink; (3) rotasi kecil elemen; (4) lapisan noise + scanline fixed di atas semua konten (mix-blend-mode: overlay).

### Named Rules
**The Paper Stack Rule.** Bayangan adalah kertas lain di bawahnya — bentuknya sama persis (clip-path sama), digeser diagonal, warna solid. Tidak pernah blur.

## Shapes

Sudut tajam atau radius maksimum 2px. Kartu memakai clip-path "sobekan" (`--torn` untuk sobekan dalam, `--torn-flat` untuk sobekan halus). Header situs punya sobekan bawah zigzag. Border tebal 2–4px solid `#161514`/`#2C2C2A`. Border dashed pink untuk baris tabel (gaya struk/tiket). Elemen ditempel dengan "selotip" (div kecil semi-transparan dengan rotasi).

## Components

### Buttons
- **Shape:** Sudut tajam (0px) untuk tombol stamp besar; radius 2px untuk tombol kecil.
- **Primary (btn-stamp):** Pink di atas border hitam 4px + bayangan offset 6px solid hitam; teks Archivo Black 20px. Hover: warna invert (hitam/pink) + animasi glitch.
- **Secondary (btn-pink):** Pink, border 2px ink, padding 10px 18px, teks Archivo Black 13px.
- **Ghost:** Teks underline abu tanpa border, untuk aksi batal.
- **Outline:** Border 1px paper, transparan, untuk aksi baris tabel (Edit).

### Badge Status (stempel)
- **Style:** Rotate -6°, JetBrains Mono 700 10px uppercase, border 2px, padding 3px 9px.
- **Confirmed:** Pink bg / paper text. **Pending:** Ink-dark bg / pink text / pink border. **Cancelled:** Transparan / abu.

### Cards / Containers
- **Corner Style:** Clip-path sobekan, tanpa radius.
- **Background:** Putih murni (#FFFFFF) untuk isi; bayangan offset `#2C2C2A` (atau pink untuk penekanan).
- **Dekorasi:** Selotip di tepi atas, stempel label ("AKSES SISTEM", "FORM BARU") menimpa sudut kiri atas dengan rotate -6°.
- **Internal Padding:** 32–36px.

### Inputs / Fields
- **Style:** Border 3px ink-dark, background xerox-paper dengan pola titik halftone (radial-gradient dots), bayangan offset 4px solid, rotasi acak ±0.4° per field.
- **Label:** Pita hitam kecil (Archivo Black 10px putih) menimpa border atas input, rotasi ±2°.
- **Focus:** Tanpa outline glow — border tetap tegas.

### Navigation
- **Style:** Header sticky hitam `#161514` dengan border bawah 3px pink dan sobekan zigzag. Logo Archivo Black 26px dengan text-shadow pink 3px + glitch on hover. Nav link Inter 600 12px uppercase; aktif = background paper/teks hitam.

### Barcode Strip (signature)
Baris bar vertikal tipis (5px) tinggi acak, mayoritas paper + selingan pink — dekorasi pemisah bergaya barcode tiket di dashboard.

## Do's and Don'ts

### Do:
- **Do** pakai bayangan offset solid dengan clip-path identik (The Paper Stack Rule).
- **Do** rotasi elemen kecil 1–8° untuk kesan tempelan tangan; badge selalu -6°.
- **Do** pakai efek double-print pink pada semua judul besar.
- **Do** pertahankan noise + scanline overlay di semua halaman.
- **Do** pakai uppercase untuk heading, label, dan tombol.

### Don't:
- **Don't** pakai border-radius > 2px atau rounded penuh.
- **Don't** pakai box-shadow blur/realistis.
- **Don't** pakai gradient halus atau glassmorphism.
- **Don't** sebar pink ke elemen non-penting (The Stamp Ink Rule).
- **Don't** pakai font di luar Archivo Black / Inter / JetBrains Mono / UnifrakturCook.
