<?
// app/Http/Middleware/MidtransConfig.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Midtrans\Config;

class MidtransConfig
{
    public function handle(Request $request, Closure $next)
    {
        // Setel konfigurasi Midtrans menggunakan nilai dari config/midtrans.php
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$apiUrl = config('midtrans.api_url');

        return $next($request);  // Melanjutkan ke request berikutnya
    }
}
