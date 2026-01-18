<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service; // Sesuaikan dengan nama model layananmu
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Mengirim data layanan ke semua view
    // 'layout.app' sesuaikan dengan nama file blade layout kamu, atau gunakan '*' untuk semua view
    View::composer('*', function ($view) {
        // Ubah Service::all() menjadi:
$view->with('global_services', Service::where('is_active', true)->get());
    });
}
}
