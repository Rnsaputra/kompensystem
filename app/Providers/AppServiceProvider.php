<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- TAMBAHKAN KODE INI ---
        // Jika aplikasi diakses via Ngrok (atau HTTPS production), paksa HTTPS
        if (config('app.env') !== 'local' || str_contains(request()->url(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }
        // --------------------------
    }
}
