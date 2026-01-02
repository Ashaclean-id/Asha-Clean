<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\LandingSetting;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Menampilkan Halaman Form Pemesanan
     */
    public function index($id)
    {
        // 1. Cari layanan yang dipilih user
        // Kita pakai findOrFail supaya kalau ID ngawur, muncul 404
        $service = Service::where('is_active', 1)->findOrFail($id);

        // 2. Ambil setting (untuk footer/navbar)
        $setting = LandingSetting::first();

        // 3. Tampilkan view formulir
        return view('pesan.index', compact('service', 'setting'));
    }

    /**
     * Proses Submit Pesanan (Simpan ke Database & Redirect WA)
     * Nanti kita isi bagian ini di langkah berikutnya setelah formnya jadi.
     */
    public function submit(Request $request)
    {
        // ... coming soon ...
        dd($request->all()); // Cek data dulu
    }
}