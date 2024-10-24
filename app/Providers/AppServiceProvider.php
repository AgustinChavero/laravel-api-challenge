<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        # Habilitar restricciones de clave foranea en SQLite
        if (config('database.default') === 'sqlite') {
            Schema::enableForeignKeyConstraints();
        }
    }
}
