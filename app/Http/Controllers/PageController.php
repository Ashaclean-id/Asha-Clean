<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting; 
use App\Models\Service;
use App\Models\Review; // Pastikan Model Review dipanggil

class PageController extends Controller
{
    /**
     * Halaman Home (Landing Page)
     */
    public function home()
    {
        // 1. Ambil Setting Website
        $setting = LandingSetting::first();
        if (!$setting) {
            $setting = new LandingSetting(); 
            $setting->hero_title = 'Layanan Kebersihan Profesional';
            $setting->hero_description = 'Deskripsi default sistem...';
            $setting->show_ulasan = true;
        }

        // 2. Ambil Layanan Aktif
        $services = Service::where('is_active', 1)->get();

        // 3. AMBIL ULASAN (YANG STATUSNYA APPROVED)
        // Kita ambil 6 ulasan terbaru beserta data servicenya
        $reviews = Review::with('service')
                    ->where('status', 'approved')
                    ->latest()
                    ->take(6)
                    ->get();

        // 4. Kirim SEMUA data (setting, services, reviews) ke view 'home' sekaligus
        return view('home', compact('setting', 'services', 'reviews'));
    }

    /**
     * Halaman Daftar Layanan (Public)
     */
    public function services()
    {
        // Ambil semua layanan aktif
        $services = Service::where('is_active', 1)->get();
        
        // Ambil setting untuk header/footer
        $setting = LandingSetting::first();

        // Sementara arahkan ke home jika file view 'services.index' belum ada
        // Jika nanti sudah buat view khusus list layanan, ganti jadi: view('services.index', ...)
        return view('home', compact('services', 'setting')); 
    }
}