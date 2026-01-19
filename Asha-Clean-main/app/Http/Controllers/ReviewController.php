<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use App\Models\LandingSetting; // Biar header/footer aman
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Tampilkan Form Tulis Ulasan
     */
    public function create()
    {
        $setting = LandingSetting::first();
        // Kita kirim data services biar user bisa pilih layanan apa yang di-review
        $services = Service::where('is_active', 1)->get(); 

        return view('reviews.create', compact('setting', 'services'));
    }

    /**
     * Simpan Ulasan ke Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500',
            'service_id' => 'nullable|exists:services,id',
        ]);

        Review::create([
            'name' => Auth::user()->name,   // Ambil nama dari User Login
            'email' => Auth::user()->email, // Ambil email dari User Login
            'rating' => $request->rating,
            'content' => $request->content,
            'service_id' => $request->service_id,
            'status' => 'approved', 
        ]);

        return redirect()->route('home.landing')->with('success', 'Terima kasih! Ulasan Anda telah dikirim dan menunggu moderasi admin.');
    }
}