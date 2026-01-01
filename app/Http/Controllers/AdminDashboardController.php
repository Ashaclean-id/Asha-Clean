<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting; // <--- WAJIB ADA

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data setting pertama
        $setting = LandingSetting::first();

        // JAGA-JAGA: Kalau lupa tinker, kita buat data dummy otomatis supaya tidak error
        if (!$setting) { $setting = new \App\Models\LandingSetting(); }
        if (!$setting) {
            $setting = LandingSetting::create([
                'hero_title' => 'Layanan Kebersihan',
                'hero_description' => 'Deskripsi default sistem.',
                'show_ulasan' => true
            ]);
        }

        return view('admin.dashboard', compact('setting'));
    }

    public function updateSettings(Request $request)
{
    // Cari data setting, kalau tidak ada buat baru
    $setting = LandingSetting::firstOrNew([], [
        'hero_title' => 'Layanan Kebersihan',
        'hero_description' => 'Deskripsi default...',
    ]);

    // 1. Ambil semua input KECUALI gambar dan toggle
    $data = $request->except(['promo_1_image', 'promo_2_image', 'promo_3_image', 'show_ulasan', 'show_promotions', 'show_quick_support']); 

    // 2. Proses Upload Gambar (Looping)
    foreach (['promo_1_image', 'promo_2_image', 'promo_3_image'] as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store('promos', 'public');
            $data[$field] = $path;
        }
    }

    // 3. HANDLE SEMUA TOGGLE (CHECKBOX) - INI SOLUSINYA MIN!
    // Logika: Jika dicentang simpan 1, jika tidak simpan 0
    $data['show_ulasan']      = $request->has('show_ulasan') ? 1 : 0;
    $data['show_promotions']  = $request->has('show_promotions') ? 1 : 0; // <--- INI BARU
    $data['show_quick_support'] = $request->has('show_quick_support') ? 1 : 0;

    // 4. Simpan ke Database
    $setting->fill($data);
    $setting->save();

    return redirect()->back()->with('success', 'Semua pengaturan berhasil disimpan!');
}
}