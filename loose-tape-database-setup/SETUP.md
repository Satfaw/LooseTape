# Setup database — Loose Tape

## 1. Kalau project Laravel belum ada

```bash
composer create-project laravel/laravel loose-tape
cd loose-tape
```

## 2. Buat database MySQL

```bash
mysql -u root -p -e "CREATE DATABASE loose_tape;"
```

Sesuaikan `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loose_tape
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Copy file migration & model

Copy isi folder `database/migrations/` dan `app/Models/` dari zip ini ke lokasi yang sama di project Laravel kamu (timpa file `Booking.php`/`Studio.php`/`Transaksi.php` kalau sudah ada, jangan timpa `User.php` bawaan Laravel — tinggal tambahin trait di langkah 5).

## 4. Install spatie/laravel-permission (buat role & akses)

```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Ini generate migration tambahan (`roles`, `permissions`, `model_has_roles`, dll) — otomatis, nggak perlu bikin manual.

## 5. Tambahin trait HasRoles ke User model

Buka `app/Models/User.php`, tambahin:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles; // tambahkan baris ini
    // ...
}
```

## 6. Jalankan migration

```bash
php artisan migrate
```

Urutan migration udah diatur pakai timestamp di nama file, jadi `studios` duluan → `bookings` (butuh `studios` & `users`) → `transaksis` (butuh `bookings`). Kalau ada error "table already exists" pas migrate ulang, pakai `php artisan migrate:fresh`.

## 7. (Opsional tapi disaranin) Seed role & akun admin awal

```bash
php artisan tinker
```

Lalu jalankan di dalam tinker:

```php
$admin = \App\Models\User::factory()->create([
    'name' => 'Admin Loose Tape',
    'email' => 'admin@loosetape.test',
    'password' => bcrypt('password'),
]);
$admin->assignRole('admin'); // pastikan role 'admin' udah dibuat, atau bikin dulu:
// \Spatie\Permission\Models\Role::create(['name' => 'admin']);
```

## 8. Install Filament (kalau belum)

```bash
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
php artisan make:filament-user
```

Setelah ini baru lanjut bikin Filament Resource buat masing-masing tabel (`StudioResource`, `BookingResource`, dll) — itu langkah berikutnya.
