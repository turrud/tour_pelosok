<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        // \Midtrans\Config::$curlOptions = [
        //     CURLOPT_SSL_VERIFYPEER => false, // Matikan verifikasi SSL
        // ];

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}