<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting;
use App\Models\Service;
use App\Models\Review;

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

        // 3. ULASAN PREVIEW (MAX 3)
        $reviewsPreview = Review::with('service')
            ->where('status', 'approved')
            ->latest()
            ->take(3)
            ->get();

        // 4. SEMUA ULASAN
        $reviewsAll = Review::with('service')
            ->where('status', 'approved')
            ->latest()
            ->get();

        // 5. Kirim ke view
        return view('home', compact(
            'setting',
            'services',
            'reviewsPreview',
            'reviewsAll'
        ));
    }

    /**
     * Halaman Daftar Layanan (Public)
     */
    public function services()
    {
        $services = Service::where('is_active', 1)->get();
        $setting = LandingSetting::first();

        return view('home', compact('services', 'setting'));
    }
}
