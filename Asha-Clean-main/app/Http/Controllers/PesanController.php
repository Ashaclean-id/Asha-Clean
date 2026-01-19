<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItem; // Pastikan Model BookingItem diimport
use App\Models\Service;
use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PesanController extends Controller
{
    /**
     * TAMPILKAN FORM BOOKING
     * Menangkap data pilihan dari halaman sebelumnya (show service)
     */
    public function index(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        // 1. Tangkap Data "Nama|Harga" dari halaman sebelumnya
        $rawItems = $request->input('custom_items', []); 
        
        $selectedItems = [];
        $totalPrice = 0;

        // 2. Olah Data Pilihan
        if (!empty($rawItems)) {
            foreach ($rawItems as $item) {
                $parts = explode('|', $item);
                if (count($parts) == 2) {
                    $name = $parts[0];
                    $price = (int)$parts[1];
                    
                    $selectedItems[] = [
                        'name' => $name,
                        'price' => $price
                    ];
                    $totalPrice += $price;
                }
            }
        } else {
            // 3. Default jika tidak ada pilihan
            $selectedItems[] = [
                'name' => $service->name . ' (Paket Standar)',
                'price' => $service->price
            ];
            $totalPrice = $service->price;
        }

        return view('pesan.index', compact('service', 'selectedItems', 'totalPrice'));
    }

    /**
     * PROSES SIMPAN PESANAN & MIDTRANS
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
            'items'        => 'nullable|array', // Array rincian item
        ]);

        $service = Service::find($request->service_id);

        // 2. Hitung Ulang Total Harga (Dari data yang dikirim form)
        $totalPrice = 0;
        $itemDetailsMidtrans = []; // Array Item Khusus Midtrans

        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $price = (int)$item['price'];
                $totalPrice += $price;

                // Siapkan data item untuk Midtrans
                $itemDetailsMidtrans[] = [
                    'id'       => 'ITEM-' . rand(100,999), // ID random unik per item
                    'price'    => $price,
                    'quantity' => 1,
                    'name'     => substr($item['name'], 0, 50), // Midtrans limit nama 50 char
                ];
            }
        } else {
            // Fallback (Paket Standar)
            $totalPrice = $service->price;
            $itemDetailsMidtrans[] = [
                'id'       => $service->id,
                'price'    => (int)$service->price,
                'quantity' => 1,
                'name'     => substr($service->name, 0, 50),
            ];
        }

        // 3. Simpan Booking Utama
        $booking = Booking::create([
            'service_id'     => $request->service_id,
            'user_id'        => auth()->id() ?? null,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'booking_date'   => $request->booking_date,
            'booking_time'   => $request->booking_time,
            'notes'          => $request->notes,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
            'total_price'    => $totalPrice, // Total yang sudah dihitung ulang
        ]);

        // 4. Simpan Rincian Item ke Database (Tabel booking_items)
        // INI PENTING: Biar admin tau detail pesanan user
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'item_name'  => $item['name'],
                    'price'      => $item['price'],
                ]);
            }
        } else {
            BookingItem::create([
                'booking_id' => $booking->id,
                'item_name'  => $service->name . ' (Paket Standar)',
                'price'      => $service->price,
            ]);
        }

        // 5. KONFIGURASI MIDTRANS
        Config::$serverKey = trim(config('midtrans.server_key'));
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 6. Siapkan Parameter Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . $booking->id . '-' . time(),
                'gross_amount' => (int) $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone,
            ],
            // Kirim rincian item ke Midtrans biar muncul di halaman pembayaran
            'item_details' => $itemDetailsMidtrans 
        ];

        // 7. Minta Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            
            $booking->snap_token = $snapToken;
            $booking->save();

            return redirect()->route('pesan.payment', $booking->id);

        } catch (\Exception $e) {
            $booking->delete(); // Hapus booking gagal biar bersih
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * HALAMAN PEMBAYARAN
     */
    public function payment($id)
    {
        // Load booking beserta item-nya biar bisa ditampilkan di halaman payment
        $booking = Booking::with(['service', 'items'])->findOrFail($id);
        $setting = LandingSetting::first();
        
        if (!$booking->snap_token) {
            return redirect()->route('home.landing')->with('error', 'Token pembayaran tidak ditemukan.');
        }

        return view('pesan.payment', compact('booking', 'setting'));
    }

    /**
     * HALAMAN SUKSES
     */
    public function success($id)
    {
        $booking = Booking::with(['service', 'items'])->findOrFail($id);

        // Simulasi sukses (Production pakai Webhook)
        if($booking->payment_status == 'unpaid') {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'approved' 
            ]);
        }

        $setting = LandingSetting::first();
        return view('pesan.success', compact('booking', 'setting'));
    }
}