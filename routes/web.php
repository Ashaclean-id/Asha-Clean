<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController; 
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\ReviewController;
use Illuminate\Database\Schema\Blueprint;

/*
|--------------------------------------------------------------------------
| PAGE (STATIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home.landing');
Route::get('/services', [PageController::class, 'services'])->name('services.index');

/*
|--------------------------------------------------------------------------
| SERVICES DYNAMIC (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');


/*
|--------------------------------------------------------------------------
| ORDER / PEMESANAN (PESAN CONTROLLER)
|--------------------------------------------------------------------------
*/
// 1. Form Pesan
Route::get('/pesan/{id}', [PesanController::class, 'index'])->name('pesan.index');

// 2. Submit Pesanan
Route::post('/pesan', [PesanController::class, 'submit'])->name('pesan.submit');

// 3. Halaman Pembayaran (Midtrans)
Route::get('/pembayaran/{id}', [PesanController::class, 'payment'])->name('pesan.payment');

// 4. Halaman Sukses Bayar (PERBAIKAN DISINI)
// Tadi namanya 'booking.success', kita ubah jadi 'pesan.success' biar sinkron
Route::get('/pembayaran/sukses/{id}', [PesanController::class, 'success'])->name('pesan.success');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/home', [PageController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

// Profile & Register
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('/forgot-password', function () { return 'Forgot password page not implemented yet'; })->name('password.request');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Ini Route CRUD yang nyambung ke ServiceController bagian Admin
        Route::resource('services', ServiceController::class);
        
        Route::put('/settings/update', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
    });

// untuk booking admin
Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
Route::put('/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
Route::delete('/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

// untuk ulasan admin
Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
Route::put('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('admin.reviews.updateStatus');
Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

// untuk user menulis ulasan
Route::middleware(['auth'])->group(function () {
    Route::get('/write-review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});