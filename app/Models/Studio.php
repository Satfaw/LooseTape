<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Studio extends Model
{
    protected $fillable = [
        'nama_studio',
        'deskripsi',
        'harga_per_jam',
        'status',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
