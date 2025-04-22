<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Daftarkan layanan atau binding service container di sini, jika perlu.
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Menghubungkan kebijakan ProductPolicy dengan model Product
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
