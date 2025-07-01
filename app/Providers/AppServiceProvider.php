<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot(): void
    {
        // Fuerza a Laravel a generar todas las URLs con HTTPS
        // Esto es crucial para solucionar problemas de Contenido Mixto detrás de proxies HTTPS.
        URL::forceScheme('https');
    }
}
