<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PesanController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/services', [PageController::class, 'services']);
Route::get('/services/cuci-sofa-kasur-karpet', [ServiceController::class, 'cuci'])->name('services.cuci');


Route::get('/pesan/{service}', [PesanController::class, 'index'])->name('pesan.index');
Route::post('/pesan/submit', [PesanController::class, 'submit'])->name('pesan.submit');