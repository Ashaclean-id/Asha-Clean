<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // ==========================================
    // BAGIAN 1: PUBLIC (TAMPILAN UNTUK USER)
    // ==========================================

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        $setting = LandingSetting::first();
        return view('services.show', compact('service', 'setting'));
    }


    // ==========================================
    // BAGIAN 2: ADMIN (MANAJEMEN CRUD)
    // ==========================================

    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * PERBAIKAN DI SINI:
     * Kita buang inputan benefit_1_title dll dari $data utama
     * supaya database tidak bingung.
     */
    public function store(Request $request)
{
    // 1. Validasi
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric', // Ini jadi "Harga Mulai Dari"
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // 2. EXCLUDE INPUTAN SEMENTARA
    $excludedFields = ['image'];
    
    // Exclude Benefits (1-4)
    for ($i = 1; $i <= 4; $i++) {
        $excludedFields[] = "benefit_{$i}_title";
        $excludedFields[] = "benefit_{$i}_desc";
    }
    
    // Exclude Pricelist (Kita siapin slot sampai 10 harga)
    for ($i = 1; $i <= 10; $i++) {
        $excludedFields[] = "price_name_{$i}";
        $excludedFields[] = "price_value_{$i}";
    }

    // 3. Bersihkan Data
    $data = $request->except($excludedFields);
    $data['slug'] = Str::slug($request->name);
    
    // Upload Gambar
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('services', 'public');
    }

    $data['is_active'] = $request->has('is_active') ? 1 : 0;
    $data['show_booking'] = $request->has('show_booking') ? 1 : 0;

    // 4. HANDLE BENEFITS (Yang tadi sudah ada)
    $benefits = [];
    for ($i = 1; $i <= 4; $i++) {
        // Hanya simpan jika judulnya diisi
        if ($request->filled("benefit_{$i}_title")) {
            $benefits[] = [
                'title' => $request->input("benefit_{$i}_title"),
                'desc'  => $request->input("benefit_{$i}_desc")
            ];
        }
    }
    $data['benefits'] = $benefits;

    // 5. HANDLE PRICELIST (BARU!) 
    // Kita buat loop 10 slot. Kalau admin isi, kita simpan.
    $pricelist = [];
    for ($i = 1; $i <= 10; $i++) {
        if ($request->filled("price_name_{$i}")) {
            $pricelist[] = [
                'name'  => $request->input("price_name_{$i}"),
                'price' => $request->input("price_value_{$i}")
            ];
        }
    }
    $data['pricelist'] = $pricelist; // Masukkan ke database

    Service::create($data);

    return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dibuat!');
}

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        // 1. DAFTAR KOLOM YANG DI-EXCLUDE (SAMA SEPERTI STORE)
        $excludedFields = ['image'];
        for ($i = 1; $i <= 4; $i++) {
            $excludedFields[] = "benefit_{$i}_title";
            $excludedFields[] = "benefit_{$i}_desc";
        }

        // 2. Bersihkan Data
        $data = $request->except($excludedFields);
        
        $data['slug'] = Str::slug($request->name);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['show_booking'] = $request->has('show_booking') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // 3. HANDLE JSON BENEFITS (UPDATE)
        $benefits = [];
        for ($i = 1; $i <= 4; $i++) {
            $benefits[] = [
                'title' => $request->input("benefit_{$i}_title"),
                'desc'  => $request->input("benefit_{$i}_desc")
            ];
        }
        $data['benefits'] = $benefits;

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan dihapus!');
    }
}