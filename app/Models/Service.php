<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi (mass assignment)
    protected $guarded = [];
    protected $casts = [
        'benefits' => 'array', // Casting JSON ke Array
    ];

    // Otomatis generate slug saat membuat layanan baru (Opsional tapi keren)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = \Illuminate\Support\Str::slug($service->name);
            }
        });
    }
}