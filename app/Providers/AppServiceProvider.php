<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Contoh: Mendaftarkan view composer untuk semua view
        View::composer('*', function ($view) {
            $view->with('appUrl', config('app.url'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Registrasi layanan ke service container
    }
}

