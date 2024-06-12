<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Cashier\User;
use Laravel\Cashier\Cashier;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Manually register Telescope's service providers for local/dev use only
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Cashier::useCustomerModel(User::class);
        Cashier::calculateTaxes();
    }
}
