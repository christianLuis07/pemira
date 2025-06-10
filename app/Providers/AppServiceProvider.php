<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('different_year', function ($attribute, $value, $parameters, $validator) {
            try {
                list($startYear, $endYear) = explode('/', $value);
                return $startYear !== $endYear;
            } catch (\Throwable $th) {
                return false;
            }
        });
    }
}
