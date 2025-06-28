<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('kategori', KategoriController::class);
Route::resource('pesanan', PesananController::class);

Route::get ('/dashboard', function () {
    return view('dashboard', [HomeController::class, 'index']) ->name('dashboard');
});