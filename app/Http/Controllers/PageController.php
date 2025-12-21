<?php

namespace App\Http\Controllers;

use App\Models\ServicePage;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function serviceDetail($slug)
{
    $service = ServicePage::with('tools')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('services.show', compact('service'));
}
}
