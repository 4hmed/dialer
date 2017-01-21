<?php

namespace App\Providers;

use Hash;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

            return Hash::check($value, current($parameters));

        });

        // it is for integer type element required.
        Validator::extend('numeric_array', function ($attribute, $value, $parameters, $validator)
        {
            foreach ($value as $v) {
                if (!is_numeric($v)) {
                    return false;
                }
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
