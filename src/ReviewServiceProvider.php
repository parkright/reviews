<?php

namespace Parkright\Reviews;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Parkright\Reviews\Models\Review;

class ReviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Blade::componentNamespace('Parkright\\Reviews\\View\\Components', 'review');

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'reviews');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'review');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('reviews.php'),
            ], 'review-config');

            // Publishing the migrations.

            $this->publishes([
               __DIR__ . '/../database/migrations' => database_path('migrations')
            ], 'review-migrations');
            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/reviews'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/reviews'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/reviews'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'reviews');

        // Register the main class to use with the facade
        $this->app->singleton('review', function () {
            return new Review;
        });
    }
}
