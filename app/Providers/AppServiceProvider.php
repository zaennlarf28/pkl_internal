<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Inject variabel global ke semua view
        View::composer('*', function ($view) {
            // karena sistem keranjang tidak dipakai lagi
            $view->with('cartItems', collect()); 
        });
    }
}
