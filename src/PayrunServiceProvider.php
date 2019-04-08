<?php

namespace Appoly\Payrun;

use Appoly\Payrun\PayrunFacade;
use Illuminate\Support\ServiceProvider;

class PayrunServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('payrun.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'payrun');

        // Register the main class to use with the facade
        $this->app->singleton('payrun', function () {
            return new PayrunFacade();
        });
    }
}
