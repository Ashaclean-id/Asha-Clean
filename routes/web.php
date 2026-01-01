<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController; // Untuk Admin CRUD
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PAGE (STATIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home.landing'); // Saya kasih nama biar aman
Route::get('/services', [PageController::class, 'services'])->name('services.index');

/*
|--------------------------------------------------------------------------
| SERVICES DYNAMIC (BAGIAN PENTING)
|--------------------------------------------------------------------------
| Ini adalah "Jalur Utama". Apapun slug yang diketik (misal: /services/cuci-sofa),
| akan ditangkap oleh controller ini dan dicari di database.
| SAYA HAPUS redirect manual di bawahnya karena itu yang bikin error 404.
*/
Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])
    ->name('services.show');


/*
|--------------------------------------------------------------------------
| PEMESANAN (BOOKING)
|--------------------------------------------------------------------------
*/
Route::get('/pesan/{service}', [PesanController::class, 'index'])
    ->name('pesan.index');

Route::post('/pesan/submit', [PesanController::class, 'submit'])
    ->name('pesan.submit');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Halaman Home setelah login
Route::get('/home', [PageController::class, 'home'])
    ->middleware(['auth', 'verified']) // Biarkan middleware ini kalau mau halaman ini khusus member
    ->name('home');

// profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/forgot-password', function () {
    return 'Forgot password page not implemented yet';
})->name('password.request');


// admin
Route::middleware(['auth', 'role:admin']) // Pastikan middleware-nya benar
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Cek baris ini:
        // URL: /admin/dashboard
        // Controller: AdminDashboardController
        // Method: index
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('services', ServiceController::class);
        Route::put('/settings/update', [AdminDashboardController::class, 'updateSettings'])
            ->name('settings.update');
            
        // ... route services lainnya ...
    });