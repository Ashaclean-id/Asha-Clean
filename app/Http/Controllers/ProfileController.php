<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Contoh dummy order (nanti ganti relasi DB)
        $orders = [
            ['service' => 'Deep Clean Sofa', 'date' => '2023-12-24', 'total' => '150.000', 'status' => 'Selesai'],
            ['service' => 'Service AC Split', 'date' => '2023-12-10', 'total' => '75.000', 'status' => 'Selesai'],
        ];

        return view('profile.index', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Auth::user()->update($request->only('name','phone','address'));

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
}
