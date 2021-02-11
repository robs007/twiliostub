<?php

namespace Robs007\Twiliostub;

use Exception;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class TwiliostubServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'robs007');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'robs007');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/twiliostub.php', 'twiliostub');

        // Register the service the package provides.
        $this->app->bind('twiliostub', function () {
            $this->ensureConfigValuesAreSet();
            $client = new Client(config('twiliostub.account_sid'), config('twiliostub.auth_token'));

            return new Twiliostub($client);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['twiliostub'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/twiliostub.php' => config_path('twiliostub.php'),
        ], 'twiliostub.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/robs007'),
        ], 'twiliostub.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/robs007'),
        ], 'twiliostub.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/robs007'),
        ], 'twiliostub.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function ensureConfigValuesAreSet()
    {
        $mandatoryAttributes = config('twiliostub');

        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw new Exception("Please provide a value for ${key}");
            }
        }
    }

}
