<?php

namespace App\Http\Controllers;

use App\Models\Booking; 
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
    // 1. Validasi Input
    $request->validate([
        'service_id'   => 'required|exists:services,id',
        'name'         => 'required|string|max:255',
        'phone'        => 'required|numeric',
        'address'      => 'required|string',
        'booking_date' => 'required|date',
        'booking_time' => 'required',
    ]);

    // 2. Simpan ke Database
    $booking = Booking::create($request->all());

    // 3. Ambil Data Pendukung (Nama Layanan & No WA Admin)
    $service = Service::find($request->service_id);
    $setting = LandingSetting::first();
    
    // Default nomor WA jika di database setting kosong (Jaga-jaga)
    $adminPhone = $setting->whatsapp_number ?? '628123456789'; 

    // 4. Format Pesan WhatsApp
    // Kita buat pesan yang rapi supaya Admin enak bacanya
    $message = "Halo Admin Asha Clean, saya ingin memesan layanan:\n\n";
    $message .= "🧹 *Layanan:* " . $service->name . "\n";
    $message .= "👤 *Nama:* " . $request->name . "\n";
    $message .= "📅 *Tanggal:* " . date('d M Y', strtotime($request->booking_date)) . "\n";
    $message .= "⏰ *Jam:* " . $request->booking_time . "\n";
    $message .= "🏠 *Alamat:* " . $request->address . "\n";
    
    if ($request->notes) {
        $message .= "📝 *Catatan:* " . $request->notes . "\n";
    }
    
    $message .= "\nMohon konfirmasinya, terima kasih!";

    // 5. Redirect ke WhatsApp API
    // (Otomatis buka aplikasi WA di HP atau Web di Laptop)
    $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

    return redirect()->away($waUrl);
}
}