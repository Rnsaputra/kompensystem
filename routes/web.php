<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UsersController;



// Resource Dashboard (Tanpa Login)
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

// PROTECTED ROUTES (Harus Login)

Route::middleware(['auth'])->group(function () {

    Route::resource('dashboard', DashboardController::class);
    Route::resource('kompensasi', DataController::class);
    Route::post('/kompensasi/update-rumus', [DataController::class, 'updatePengali'])->name('kompensasi.update_rumus');
    Route::get('/recap', [DataController::class, 'recap'])->name('recap.index');
    Route::post('/recap/toggle', [DataController::class, 'toggleDay'])->name('recap.toggle');
    Route::get('/recap/export', [DataController::class, 'exportExcel'])->name('recap.export');
});
