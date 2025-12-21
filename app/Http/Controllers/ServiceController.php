<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
   public function kasur()
{
    $service = [
        'title' => 'Cuci Kasur',
        'description' => 'Layanan cuci kasur profesional, higienis, dan cepat.',
        'image' => 'services/kasur.jpg',
        'tools' => [
            [
                'icon' => '🧼',
                'name' => 'Vacuum Cleaner',
                'description' => 'Membersihkan debu dan tungau'
            ],
            [
                'icon' => '💨',
                'name' => 'Steam Cleaner',
                'description' => 'Membunuh bakteri dan jamur'
            ],
        ],
    ];

    return view('services.kasur', compact('service'));
}
}
