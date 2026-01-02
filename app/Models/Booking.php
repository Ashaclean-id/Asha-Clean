<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = []; // Izinkan semua kolom diisi

    // Relasi: Satu Booking memiliki Satu Layanan
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}