<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function kasur()
    {
        return view('services.kasur');
    }
}
