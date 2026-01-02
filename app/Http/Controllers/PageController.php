<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting; 
use App\Models\Service;        

class PageController extends Controller
{
    /**
     * Halaman Home (Landing Page)
     */
    public function home()
    {
        $setting = LandingSetting::first();
        if (!$setting) {
            $setting = new LandingSetting(); 
            $setting->hero_title = 'Layanan Kebersihan Profesional';
            $setting->hero_description = 'Deskripsi default sistem...';
            $setting->show_ulasan = true;
        }

        $services = Service::where('is_active', 1)->get();

        return view('home', compact('setting', 'services'));
    }

    /**
     * Halaman Daftar Layanan (Public)
     * Ini yang bikin error tadi karena sebelumnya tidak ada.
     */
    public function services()
    {
        // Ambil semua layanan aktif
        $services = Service::where('is_active', 1)->get();
        
        // Ambil setting untuk header/footer
        $setting = LandingSetting::first();

        // Kita tampilkan di view 'services.index' (Nanti kita buat filenya)
        // Kalau filenya belum ada, sementara kita arahkan ke 'home' dulu biar tidak error
        return view('home', compact('services', 'setting')); 
    }

    /**
     * Halaman Detail Layanan
     */
    // ... method serviceDetail atau show (jika ada) ...
}