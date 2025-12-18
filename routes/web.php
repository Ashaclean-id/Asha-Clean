<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminDashboardController;

use App\Http\Controllers\Auth\RegisterController;


/*
|--------------------------------------------------------------------------
| PAGE (STATIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');

/*
|--------------------------------------------------------------------------
| SERVICES (DETAIL)
|--------------------------------------------------------------------------
*/
Route::prefix('services')->name('services.')->group(function () {

    // Layanan utama
    Route::get('/cuci-sofa-kasur-karpet', [ServiceController::class, 'cuci'])
        ->name('cuci');

    Route::get('/kasur', [ServiceController::class, 'kasur'])
        ->name('kasur');

    Route::get('/sofa', [ServiceController::class, 'sofa'])
        ->name('sofa');

    Route::get('/karpet', [ServiceController::class, 'karpet'])
        ->name('karpet');

    Route::get('/baby-care', [ServiceController::class, 'baby'])
        ->name('baby');

    Route::get('/general-cleaning', [ServiceController::class, 'general'])
        ->name('general');

    Route::get('/interior-mobil', [ServiceController::class, 'mobil'])
        ->name('mobil');
});

/*
|--------------------------------------------------------------------------
| PESAN / BOOKING
|--------------------------------------------------------------------------
*/
Route::get('/pesan/{service}', [PesanController::class, 'index'])
    ->name('pesan.index');

Route::post('/pesan/submit', [PesanController::class, 'submit'])
    ->name('pesan.submit');


// buat login

Route::get('/login', function () { return view('auth.login');})->name('login');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/review', [ReviewController::class, 'create']);});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
});

//register

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// route dummy forgot pw

Route::get('/forgot-password', function () {return 'Forgot password page not implemented yet';})->name('password.request');
