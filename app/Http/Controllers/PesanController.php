<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index($service)
    {
        // daftar layanan dan harga
        $services = [
            'sofa_kain' => [
                'S' => 60000,
                'M' => 70000,
                'L' => 80000
            ],
            'sofabed_kain' => [
                'S' => 200000,
                'M' => 250000,
                'L' => 300000
            ],
            'sofa_kulit' => [
                'S' => 50000,
                'M' => 60000,
                'L' => 70000
            ],
            'sofabed_kulit' => [
                'S' => 175000,
                'M' => 225000,
                'L' => 275000
            ],
            'sofa_relax' => [
                'fabric' => 125000,
                'kulit' => 100000
            ]
        ];

        if (!isset($services[$service])) {
            abort(404);
        }

        return view('pesan', [
            'service' => $service,
            'options' => $services[$service]
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'nama' => 'required',
            'hp' => 'required',
            'lokasi' => 'required',
            'detail' => 'required',
            'harga' => 'required'
        ]);

        return back()->with('success', 'Pesanan berhasil dikirim!');
    }
}
