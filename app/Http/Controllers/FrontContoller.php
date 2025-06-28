<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('landing-page', compact('products'));
    }
}