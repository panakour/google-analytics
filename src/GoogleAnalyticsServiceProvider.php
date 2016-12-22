<?php

namespace Panakour\Analytics;

use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/analytics.php' => config_path('analytics.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('analytics', function ($app) {
            return new Analytics($app);
        });

        $this->app->bind(
            'Panakour\Analytics\Contracts\Analytics',
            'Panakour\Analytics\Analytics'
        );
    }
}
