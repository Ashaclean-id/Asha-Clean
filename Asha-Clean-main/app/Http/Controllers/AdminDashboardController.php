<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSetting; // Import Lama (Wajib Ada)
use App\Models\Booking;        // Import Baru (Buat Statistik)
use App\Models\Service;        // Import Baru (Buat Statistik)
use Illuminate\Support\Facades\DB; // Import Baru (Buat Grafik)

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // BAGIAN 1: LOGIKA SETTING LANDING PAGE (Kodingan Lama Kamu)
        // ==========================================
        $setting = LandingSetting::first();

        // JAGA-JAGA: Kalau lupa tinker, buat data dummy otomatis
        if (!$setting) { 
            $setting = LandingSetting::create([
                'hero_title' => 'Layanan Kebersihan',
                'hero_description' => 'Deskripsi default sistem.',
                'show_ulasan' => true
            ]);
        }

        // ==========================================
        // BAGIAN 2: LOGIKA STATISTIK & GRAFIK (Kodingan Baru)
        // ==========================================
        
        // A. Statistik Kartu
        $totalPendapatan = Booking::where('payment_status', 'paid')->sum('total_price');
        $totalBooking    = Booking::count();
        $bookingPending  = Booking::where('status', 'pending')->count();
        $totalLayanan    = Service::count();

        // B. Data Grafik Pendapatan Bulanan
        $incomeData = Booking::select(
                DB::raw('MONTH(booking_date) as month'), 
                DB::raw('SUM(total_price) as total')
            )
            ->where('payment_status', 'paid')
            ->whereYear('booking_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Siapkan array 12 bulan (Jan-Des)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $incomeData[$i] ?? 0;
        }

        // ==========================================
        // BAGIAN 3: KIRIM SEMUA KE VIEW
        // ==========================================
        return view('admin.dashboard', compact(
            'setting',          // Data Setting
            'totalPendapatan',  // Data Statistik
            'totalBooking',
            'bookingPending',
            'totalLayanan',
            'chartData'         // Data Grafik
        ));
    }

    // Fungsi updateSettings JANGAN DIHAPUS (Tetap pakai yang lama)
    public function updateSettings(Request $request)
    {
        // Cari data setting, kalau tidak ada buat baru
        $setting = LandingSetting::firstOrNew([], [
            'hero_title' => 'Layanan Kebersihan',
            'hero_description' => 'Deskripsi default...',
        ]);

        // 1. Ambil semua input KECUALI gambar dan toggle
        $data = $request->except(['promo_1_image', 'promo_2_image', 'promo_3_image', 'show_ulasan', 'show_promotions', 'show_quick_support']); 

        // 2. Proses Upload Gambar
        foreach (['promo_1_image', 'promo_2_image', 'promo_3_image'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('promos', 'public');
                $data[$field] = $path;
            }
        }

        // 3. Handle Toggle
        $data['show_ulasan']        = $request->has('show_ulasan') ? 1 : 0;
        $data['show_promotions']    = $request->has('show_promotions') ? 1 : 0;
        $data['show_quick_support'] = $request->has('show_quick_support') ? 1 : 0;

        // 4. Simpan
        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Semua pengaturan berhasil disimpan!');
    }
}