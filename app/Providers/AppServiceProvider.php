<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Exceptions\ApiExceptionHandler;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerExceptionHandler();
        $this->registerTelescope();
    }

    /**
     * Register the exception handler - extends the Dingo one
     *
     * @return void
     */
    protected function registerExceptionHandler()
    {
        $this->app->singleton('api.exception', function ($app) {
            return new ApiExceptionHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'], Config('api.errorFormat'), Config('api.debug'));
        });
    }

    /**
     * Conditionally register the telescope service provider
     */
    protected function registerTelescope()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
