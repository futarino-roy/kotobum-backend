<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Auth\LineAccessTokenGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->app['auth']->extend('line-token', function ($app, $name, array $config) {
            return new LineAccessTokenGuard(Auth::createUserProvider($config['provider']), $app['request']);
        });
    }
}
