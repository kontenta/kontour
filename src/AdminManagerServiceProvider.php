<?php

namespace Erik\AdminManagerImplementation;

use Illuminate\Support\ServiceProvider;

class AdminManagerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->configure();

        $this->app->bind(
            \Erik\AdminManager\Contracts\ViewManager::class,
            ViewManager::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerResources();

        if ($this->app->runningInConsole()) {
            $this->offerPublishing();
        }
    }

    /**
     * Setup the configuration.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');
    }

    /**
     * Register the resources.
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
    }

    /**
     * Setup the resource publishing groups.
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/admin'),
        ], 'admin-views');
    }
}
