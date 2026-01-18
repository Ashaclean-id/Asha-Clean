<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Tampilkan Daftar Booking
     */
    public function index()
    {
        // Ambil data terbaru, dan load relasi 'service' biar hemat query
        $bookings = Booking::with('service')->latest()->get();
        
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Update Status (Misal: Dari Pending -> Confirmed)
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Hapus Pesanan (Kalau ada spam/dibatalkan)
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Data pesanan dihapus.');
    }
}