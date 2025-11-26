<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman home
    public function home()
    {
        return view('home');
    }

    // Halaman daftar layanan
    public function services()
    {
        return view('services.index');
    }

    // Halaman detail layanan (misalnya /services/cuci-sofa-kasur-karpet)
    public function serviceDetail($slug)
    {
        // Data layanan → samakan slug dengan tombol "Pesan Sekarang"
        $services = [
            'cuci-sofa-kain' => [
                'title' => 'Jasa Cuci Sofa Kain',
                'image' => '/images/sofa-kain.jpg',
                'desc'  => 'Layanan cuci sofa kain profesional dan aman.',
            ],
            'cuci-sofa-kasur-karpet' => [
                'title' => 'Cuci Sofa, Kasur & Karpet',
                'image' => '/images/sofa-kasur-karpet.jpg',
                'desc'  => 'Paket lengkap pembersihan sofa, kasur, dan karpet!',
            ],
            'cuci-springbed' => [
                'title' => 'Cuci Springbed',
                'image' => '/images/springbed.jpg',
                'desc'  => 'Springbed bersih, higienis, wangi.',
            ],
        ];

        // Jika slug tidak ada, tampilkan 404
        if (!isset($services[$slug])) {
            abort(404);
        }

        return view('services.detail', [
            'service' => $services[$slug],
            'slug' => $slug
        ]);
    }
}
