<?php

namespace App\Providers;

use App\Models\Capsule;
use Illuminate\Support\Facades\Route;
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
    public function boot(): void
    {
        Route::bind('capsule', function ($value) {
            return Capsule::where('id', $value)->orWhere('slug', $value)->firstOrFail();
        });
    }
}
