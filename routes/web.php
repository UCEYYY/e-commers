<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('kategori', KategoriController::class);


Route::resource(('Pesanan'), 'App\Http\Controllers\PesananController');