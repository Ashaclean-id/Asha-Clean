<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    /**
     * Menampilkan Halaman Profil & Riwayat Pesanan
     */
    public function index()
    {
        $user = Auth::user();

        // AMBIL DATA PESANAN (LOGIKA BARU)
        // 1. where('user_id', $user->id) -> Cari booking punya user ini aja
        // 2. with('service', 'items') -> Sekalian ambil data layanan & item biar cepat
        // 3. latest() -> Urutkan dari yang paling baru
        $orders = Booking::where('user_id', $user->id)
                    ->with(['service', 'items']) 
                    ->latest()
                    ->get();

        return view('profile.index', compact('user', 'orders'));
    }

    /**
     * Update Data Diri (Nama, HP, Alamat)
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'address' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
    public function updateAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('avatar')) {
        // 1. Hapus foto lama (Cek apakah ada file-nya)
        // Kita cek keberadaan file dengan path lengkap
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // 2. Simpan foto baru
        $file = $request->file('avatar');
        // Buat nama unik
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Simpan ke folder 'avatars' di disk public
        // Hasil path: "avatars/1715432_foto.png"
        $path = $file->storeAs('avatars', $filename, 'public'); 

        // 3. Update database (SIMPAN FULL PATHNYA)
        // KITA SIMPAN 'avatars/namafile.jpg' BUKAN CUMA 'namafile.jpg'
        $user->update(['avatar' => 'avatars/' . $filename]);
    }

    return back()->with('success', 'Foto profil berhasil diperbarui!');
}
}