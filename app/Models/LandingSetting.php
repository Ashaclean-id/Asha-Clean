<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    use HasFactory;

    // DAFTARKAN SEMUA KOLOM DISINI AGAR BISA DISIMPAN
    protected $fillable = [
        'hero_title',
        'hero_description',
        
        // Slot Promo (Pastikan teks dan gambar ada)
        'promo_1_text', 'promo_1_image',
        'promo_2_text', 'promo_2_image',
        'promo_3_text', 'promo_3_image',
        
        // Toggle / Switch (INI YANG SEBELUMNYA ERROR)
        'show_ulasan',
        'show_promotions',
        'show_quick_support',
        
        // Kontak
        'whatsapp_number',
    ];
}