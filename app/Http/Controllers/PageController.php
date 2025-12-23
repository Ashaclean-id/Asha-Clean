<?php

namespace App\Http\Controllers;

use App\Models\ServicePage;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function serviceDetail($slug) // Parameternya wajib $slug
    {
        // Debugging: Cek dulu apakah slug ketangkap
        // dd($slug); 

        // CARA BENAR: Cari data berdasarkan kolom 'slug', bukan ID
        $service = ServicePage::where('slug', $slug)->firstOrFail();

        // Oper data ke View
        return view('services.detail', compact('service'));
    }


}
