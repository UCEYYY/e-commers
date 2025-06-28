<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
       // $user = auth()->user();
        return view('home', compact('user'));
    }
}
