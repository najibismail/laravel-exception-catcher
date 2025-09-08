<?php

namespace NajibIsmail\LaravelExceptionCatcher;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use NajibIsmail\LaravelExceptionCatcher\Console\Commands\TestExceptionCatcher;

class ExceptionCatcherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/exception-catcher.php',
            'exception-catcher'
        );

        $this->app->singleton(ExceptionEmailer::class, function ($app) {
            return new ExceptionEmailer($app['config']['exception-catcher']);
        });

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestExceptionCatcher::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/exception-catcher.php' => config_path('exception-catcher.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/exception-catcher'),
        ], 'views');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-exception-catcher');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Register exception handler if enabled
        if (config('exception-catcher.enabled', true)) {
            $this->registerExceptionHandler();
        }
    }

    /**
     * Register the exception handler.
     */
    protected function registerExceptionHandler(): void
    {
        $this->app->singleton('exception.emailer', function ($app) {
            return $app->make(ExceptionEmailer::class);
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            ExceptionEmailer::class,
            'exception.emailer',
        ];
    }
}
