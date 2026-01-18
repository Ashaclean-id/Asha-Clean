<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Tambahkan ini biar Str::slug jalan

class Service extends Model
{
    use HasFactory;

    // 1. IZINKAN SEMUA KOLOM (MASS ASSIGNMENT)
    // Aman, asalkan validasi di controller sudah ketat (unset price_name_x tadi)
    protected $guarded = []; 

    // 2. CASTING TIPE DATA (PENTING!)
    // Ini memberitahu Laravel cara membaca kolom tertentu
    protected $casts = [
        'benefits' => 'array',       // Kolom benefits dibaca sebagai Array
        'pricelist' => 'array',      // <--- INI KUNCINYA (JSON Harga)
        'is_active' => 'boolean',    // Biar otomatis jadi true/false
        'show_booking' => 'boolean', // Biar otomatis jadi true/false
    ];

    // 3. AUTO GENERATE SLUG
    // Otomatis membuat slug (url-cantik) saat layanan dibuat
    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    // 4. RELASI LAMA (OPSIONAL)
    // Kalau kamu sudah full pakai 'pricelist' (JSON), relasi ini sebenarnya jarang dipakai.
    // Tapi biarkan saja tidak apa-apa, supaya kode lama tidak error.
    public function options()
    {
        return $this->hasMany(ServiceOption::class);
    }
}