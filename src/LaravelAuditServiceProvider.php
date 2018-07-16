<?php

namespace Toncho\LaravelAudit;

use Illuminate\Support\ServiceProvider;

use Toncho\LaravelAudit\Console\TableCommand;
use Toncho\LaravelAudit\Console\InstallCommand;
use Toncho\LaravelAudit\Contracts\Auditor;

class LaravelAuditServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param $app
     * @return void
     */
    protected function setupConfig($app)
    {
        // Migration 
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations');

        // Config
        $config = realpath(__DIR__.'/../config/audit.php');

        if ($app->runningInConsole()) {
            $this->publishes([
                $config => base_path('config/audit.php'),
            ]);
        }

        $this->mergeConfigFrom($config, 'audit');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            TableCommand::class,
            InstallCommand::class,
        ]);

        $this->app->singleton(Auditor::class, function ($app) {
            return new \Toncho\LaravelAudit\Auditor($app);
        });
    }

    /**
     * Provides
     * 
     * @return void
     */
    public function provides()
    {
        return [
            Auditor::class,
        ];
    }
}
