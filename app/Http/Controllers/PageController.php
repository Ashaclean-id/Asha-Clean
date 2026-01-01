<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting; // <--- Pastikan Model ini dipanggil

class PageController extends Controller
{
    /**
     * Menampilkan Halaman Depan (Landing Page)
     */
    public function home()
    {
        // 1. Ambil data pengaturan dari database (Hero, Promo, Ulasan)
        $setting = LandingSetting::first();

        // 2. Jaga-jaga jika database masih kosong (supaya tidak error di view)
        if (!$setting) {
            $setting = new LandingSetting(); // Buat objek kosong dummy
            // Set nilai default supaya tampilan tidak rusak
            $setting->hero_title = 'Layanan Kebersihan Profesional';
            $setting->hero_description = 'Deskripsi default sistem...';
            $setting->show_ulasan = true;
        }

        // 3. Kirim data $setting ke view 'home'
        // Dengan ini, view 'home' bisa pakai variabel $setting->hero_title, dll.
        return view('home', compact('setting'));
    }
    
}