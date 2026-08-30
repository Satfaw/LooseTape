<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = [
        'booking_id',
        'jumlah_bayar',
        'metode_bayar',
        'status_bayar',
        'tanggal_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
