<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // App\Models\Product::class => App\Policies\ProductPolicy::class,
        // App\Models\Category::class => App\Policies\CategoryPolicy::class,
        // Tidak digunakan saat ini karena kita hanya pakai user-only app.
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Tidak ada pembatasan khusus. Aplikasi ini hanya menggunakan auth biasa.
    }
}
