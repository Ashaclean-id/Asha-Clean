<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index');
    }

    public function cuci()
    {
        return view('services.cuci'); 
    }

    public function detail($slug)
    {
        return view('services.detail', compact('slug'));
    }

}
