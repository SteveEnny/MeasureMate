<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Measurement;
use App\Models\User;
use App\Policies\CustomerMeasurementPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('viewAll', function ($user, Customer $customer) {
            return $user->id === $customer->user_id;
        });
        // Gate::policy(Measurement::class, CustomerMeasurementPolicy::class);
    }
}