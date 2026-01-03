<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Midtrans\Config; // Import Midtrans
use Midtrans\Snap;   // Import Midtrans

class PesanController extends Controller
{
    public function index(Request $request, $id)
    {
        $service = Service::with('options')->findOrFail($id);
        
        // Tangkap item yang dipilih dari halaman sebelumnya (kalau ada)
        // Kita kirimkan variabel ini ke View
        $selectedItems = $request->input('selected_items', []); 

        return view('pesan.index', compact('service', 'selectedItems'));
    }

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

        // 2. Ambil Data Layanan
        $service = Service::find($request->service_id);

        // 3. Simpan Pesanan (Unpaid)
        $booking = Booking::create([
            'service_id'     => $request->service_id,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'booking_date'   => $request->booking_date,
            'booking_time'   => $request->booking_time,
            'notes'          => $request->notes,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
            'total_price'    => $service->price,
        ]);

        // 4. KONFIGURASI MIDTRANS (DENGAN PENGAMAN TRIM)
        // trim() berguna membuang spasi tak terlihat di awal/akhir kunci
        Config::$serverKey = trim(config('midtrans.server_key')); 
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 5. Siapkan Parameter
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . $booking->id . '-' . time(),
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone,
            ],
            'item_details' => [
                [
                    'id' => $service->id,
                    'price' => (int) $service->price,
                    'quantity' => 1,
                    'name' => substr($service->name, 0, 50),
                ]
            ]
        ];

        // 6. Minta Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            
            $booking->snap_token = $snapToken;
            $booking->save();

            return redirect()->route('pesan.payment', $booking->id);

        } catch (\Exception $e) {
            // Hapus booking kalau gagal biar database bersih
            $booking->delete(); 
            return back()->with('error', $e->getMessage());
        }
    }
    /**
     * Halaman Pembayaran (Akan kita buat di Tahap 3)
     */
    public function payment($id)
    {
        $booking = Booking::with('service')->findOrFail($id);
        $setting = LandingSetting::first();
        
        // Pastikan token sudah ada
        if (!$booking->snap_token) {
            return redirect()->route('home.landing')->with('error', 'Token pembayaran tidak ditemukan.');
        }

        return view('pesan.payment', compact('booking', 'setting'));
    }

    public function success($id)
    {
        $booking = Booking::with('service')->findOrFail($id);

        // UBAH STATUS JADI PAID (LUNAS)
        // Catatan: Untuk production nanti sebaiknya pakai Webhook Midtrans biar lebih aman
        if($booking->payment_status == 'unpaid') {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'approved' // Opsional: langsung approve pesanan
            ]);
        }

        $setting = LandingSetting::first();
        return view('pesan.success', compact('booking', 'setting'));
    }
}