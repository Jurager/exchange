<?php

namespace Jurager\Exchange;

use Jurager\Exchange\Interfaces\EventDispatcherInterface;
use Jurager\Exchange\Interfaces\ModelBuilderInterface;
use Jurager\Exchange\Console\Commands\PruneCommand;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Class ExchangeServiceProvider.
 */
class ExchangeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'/../publish/routes.php');

        // Config
        $this->publishes([__DIR__.'/../publish/config/' => config_path()], 'config');

        // Schedule the commands
        //
        if ($this->app->runningInConsole()) {

            // Register command
            //
            $this->commands([ PruneCommand::class]);

            // Wait until the application booted
            //
            $this->app->booted(function () {

                // Create new schedule
                //
                $schedule = $this->app->make(Schedule::class);

                // Run prunable command
                //
                $schedule->command('catalog:prune')->everyTenMinutes();
            });
        }
    }

    /**
     * Register the application services.
     */
    public function register() :void
    {
        $this->app->singleton(Config::class, function ($app) {
            return new Config($app['config']['exchange']);
        });

        $this->app->singleton(EventDispatcherInterface::class, function ($app) {
            return new EventDispatcher($app[Dispatcher::class]);
        });

        $this->app->singleton(ModelBuilderInterface::class, function ($app) {
            return $app[ModelBuilder::class];
        });
    }
}
