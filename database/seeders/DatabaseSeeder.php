<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Studio;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        foreach (['admin', 'staff', 'customer'] as $r) {
            Role::firstOrCreate(['name' => $r]);
        }

        // Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@loosetape.test'],
            ['name' => 'Admin Loose Tape', 'password' => bcrypt('password')]
        );
        $admin->syncRoles(['admin']);

        $staff = User::firstOrCreate(
            ['email' => 'staff@loosetape.test'],
            ['name' => 'Staff Loose Tape', 'password' => bcrypt('password')]
        );
        $staff->syncRoles(['staff']);

        $customer = User::firstOrCreate(
            ['email' => 'rani@loosetape.test'],
            ['name' => 'Rani Puspita', 'password' => bcrypt('password')]
        );
        $customer->syncRoles(['customer']);

        // Studios
        $studioA = Studio::firstOrCreate(['nama_studio' => 'Studio A'], [
            'deskripsi' => 'Studio band lengkap: drum, 2 gitar amp, bass amp, PA.',
            'harga_per_jam' => 75000,
            'status' => 'aktif',
        ]);
        $studioB = Studio::firstOrCreate(['nama_studio' => 'Studio B'], [
            'deskripsi' => 'Studio latihan medium, cocok untuk duo/trio.',
            'harga_per_jam' => 60000,
            'status' => 'aktif',
        ]);
        Studio::firstOrCreate(['nama_studio' => 'Studio C'], [
            'deskripsi' => 'Studio recording + vocal booth.',
            'harga_per_jam' => 100000,
            'status' => 'aktif',
        ]);

        // Bookings dummy (sekali saja)
        if (Booking::count() === 0) {
            $b1 = Booking::create([
                'user_id' => $customer->id,
                'studio_id' => $studioA->id,
                'tanggal' => now()->addDays(3)->toDateString(),
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00',
                'status' => 'confirmed',
                'no_hp' => '081234567890',
            ]);
            Transaksi::create([
                'booking_id' => $b1->id,
                'jumlah_bayar' => 150000,
                'metode_bayar' => 'tunai',
                'status_bayar' => 'lunas',
                'tanggal_bayar' => now()->toDateString(),
            ]);

            $b2 = Booking::create([
                'user_id' => $customer->id,
                'studio_id' => $studioB->id,
                'tanggal' => now()->addDays(4)->toDateString(),
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:00',
                'status' => 'pending',
                'no_hp' => '081234567890',
            ]);
            Transaksi::create([
                'booking_id' => $b2->id,
                'jumlah_bayar' => 120000,
                'metode_bayar' => 'transfer',
                'status_bayar' => 'belum_bayar',
                'tanggal_bayar' => null,
            ]);

            Booking::create([
                'user_id' => $staff->id,
                'studio_id' => $studioA->id,
                'tanggal' => now()->addDay()->toDateString(),
                'jam_mulai' => '18:00',
                'jam_selesai' => '20:00',
                'status' => 'cancelled',
                'no_hp' => '089876543210',
            ]);
        }
    }
}
