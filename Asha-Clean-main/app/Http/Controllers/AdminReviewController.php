<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        // Ambil data ulasan, urutkan dari yang terbaru
        $reviews = Review::with('service')->latest()->get();
        
        // Hitung Statistik untuk kartu di atas
        $totalReviews = Review::count();
        $avgRating = Review::avg('rating') ?? 0;
        $pendingReviews = Review::where('status', 'pending')->count();

        return view('admin.reviews.index', compact('reviews', 'totalReviews', 'avgRating', 'pendingReviews'));
    }

    public function updateStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        // Validasi input status hanya boleh yang diizinkan
        $request->validate([
            'status' => 'required|in:pending,approved,hidden'
        ]);

        $review->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status ulasan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}