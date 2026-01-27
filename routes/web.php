<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UsersController;

// Redirect halaman utama '/' langsung ke '/dashboard'

// Resource Dashboard (Tanpa Login)
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

// 2. PROTECTED ROUTES (Harus Login)
// Pastikan middleware 'auth' aktif
Route::middleware(['auth'])->group(function () {
    
    Route::resource('dashboard', DashboardController::class);
    Route::resource('kompensasi', DataController::class);
    
    // Route::resource('users', UsersController::class); // Opsional
});
// UsersController kita disable dulu (komentar/hapus) karena mau fokus dashboard
// Route::resource('users', UsersController::class);