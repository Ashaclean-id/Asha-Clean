<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicePageController;


/*
|--------------------------------------------------------------------------
| PAGE (STATIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home']);

Route::get('/services', [PageController::class, 'services']);



Route::get('/pesan/{service}', [PesanController::class, 'index'])
    ->name('pesan.index');

Route::post('/pesan/submit', [PesanController::class, 'submit'])
    ->name('pesan.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

/*
|--------------------------------------------------------------------------
| DUMMY
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', function () {
    return 'Forgot password page not implemented yet';
})->name('password.request');


// ini services

Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])
    ->name('services.show');

Route::get('/services/sofa', fn () => redirect('/services/cuci-sofa-kain'))
    ->name('services.sofa');

Route::get('/services/karpet', fn () => redirect('/services/cuci-sofa-kasur-karpet'))
    ->name('services.karpet');

Route::get('/services/baby', fn () => redirect('/services/cuci-sofa-kasur-karpet'))
    ->name('services.baby');

Route::get('/services/general', fn () => redirect('/services/cuci-sofa-kasur-karpet'))
    ->name('services.general');

Route::get('/services/mobil', fn () => redirect('/services/cuci-sofa-kasur-karpet'))
    ->name('services.mobil');