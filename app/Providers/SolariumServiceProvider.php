<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SolariumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $adapter = new \Solarium\Core\Client\Adapter\Curl();
        $eventDispatcher = new EventDispatcher();

        $this->app->bind(Client::class, function ($app) use ($adapter, $eventDispatcher) {
            return new Client($adapter, $eventDispatcher, $app['config']['solarium']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
