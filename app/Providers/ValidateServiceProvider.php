<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend('boolval', function ($attribute, $value) {
            return in_array($value, ['true', 'false', 1, 0, '1', '0']);
        });
    }
}
