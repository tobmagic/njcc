<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".env('RECAPTCHA_SECRET')."&response=".$value);
        $responseKeys = json_decode($response, true);

        return $responseKeys["success"] && $responseKeys["score"] >= 0.5; // 0.5 is typical threshold
    });
    }
}
