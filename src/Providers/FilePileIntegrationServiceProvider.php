<?php

namespace FilePile\FilePileIntegration\Providers;

use Illuminate\Support\ServiceProvider;

class FilePileIntegrationServiceProvider extends ServiceProvider{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \FilePile\FilePileIntegration\Commands\FilePile::class,
                \FilePile\FilePileIntegration\Commands\FilePileList::class,
                \FilePile\FilePileIntegration\Commands\FilePileInstallPile::class,
            ]);
        }
        $this->publishes([
            __DIR__.'/../Configuration/Templates/filepile.php' => config_path('filepile.php')
        ], 'config');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Configuration/Templates/filepile.php', 'filepile'
        );
    }

}