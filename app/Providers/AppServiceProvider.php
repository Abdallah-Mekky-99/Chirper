<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Model::preventSilentlyDiscardingAttributes($this->app->environment('local'));
        Model::preventLazyLoading($this->app->environment('local'));

        Password::defaults(function () {
            $rule = Password::min(8)->mixedCase();
            return $rule;
        });
    }
}
