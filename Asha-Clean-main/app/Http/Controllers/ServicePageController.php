<?php

namespace App\Http\Controllers;

use App\Models\ServicePage;

class ServicePageController extends Controller
{
    public function show($slug)
    {
        $service = ServicePage::where('slug', $slug)
            ->with('tools')
            ->firstOrFail();

        return view('services.show', compact('service'));
    }
}
