<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('jumlah_bayar');
            $table->enum('metode_bayar', ['tunai', 'transfer', 'qris'])->default('tunai');
            $table->enum('status_bayar', ['lunas', 'dp', 'belum_bayar'])->default('belum_bayar');
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
