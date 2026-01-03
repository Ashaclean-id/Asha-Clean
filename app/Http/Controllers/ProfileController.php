<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking; // Import Model Booking

class ProfileController extends Controller
{
    /**
     * Tampilkan Halaman Profil
     */
    public function index()
    {
        $user = Auth::user();

        // AMBIL RIWAYAT PESANAN
        // Logika: Cari booking yang nomor HP-nya sama dengan User yang login
        // (Karena di tabel booking kita simpan 'phone', bukan 'user_id')
        $orders = Booking::with(['service', 'items'])
                    ->where('phone', $user->phone) 
                    ->orderBy('created_at', 'desc')
                    ->take(5) // Ambil 5 terakhir saja
                    ->get();

        return view('profile.index', compact('user', 'orders'));
    }

    /**
     * Update Informasi Profil (Nama, HP, Alamat)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        // Update data user di tabel users (pastikan kolom phone/address ada di tabel user)
        // Jika tabel user bawaan laravel belum ada kolom phone/address, 
        // kamu perlu menambahkannya via migration, atau simpan di tabel terpisah.
        // Untuk sekarang, kita asumsikan kolomnya ada atau kita pakai update() standar.
        
        $user->name = $request->name;
        // Simpan phone & address jika kolomnya ada di tabel users
        // $user->phone = $request->phone; 
        // $user->address = $request->address;
        
        // CATATAN PENTING:
        // Jika tabel 'users' kamu belum punya kolom 'phone' dan 'address',
        // Kode di bawah ini akan error. Pastikan sudah migration 'add_phone_to_users'.
        // Jika belum, komentar dulu baris ini:
        $user->forceFill([
            'phone' => $request->phone,
            'address' => $request->address,
        ])->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai!']);
        }

        // Update password baru
        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}