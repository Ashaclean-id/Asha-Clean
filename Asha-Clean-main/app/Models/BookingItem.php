<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    use HasFactory;

    // INI YANG HARUS DITAMBAHKAN
    protected $fillable = [
        'booking_id',
        'item_name',
        'price'
    ];
    
    // Atau bisa pakai ini biar lebih simpel (mengizinkan semua kolom):
    // protected $guarded = [];

    // Relasi balik ke Booking (Opsional tapi bagus buat nanti)
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}