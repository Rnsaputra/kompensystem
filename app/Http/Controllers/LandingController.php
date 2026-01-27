<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Kompen; // Uncomment nanti jika sudah ada Model

class LandingController extends Controller
{
    public function index()
    {
        // Nanti diganti dengan: $data = Kompen::latest()->take(10)->get();
        // Untuk sekarang kita kirim array kosong dulu agar tidak error view-nya
        $data = [];

        return view('landing'); // Kita akan buat file landing.blade.php
    }
}
