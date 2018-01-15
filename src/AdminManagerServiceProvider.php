<?php

namespace Erik\AdminManagerImplementation;

use Illuminate\Auth\AuthManager;
use Illuminate\Support\ServiceProvider;

class AdminManagerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->configure();

        $this->app->bindIf(
            \Erik\AdminManager\Contracts\AdminGuard::class,
            function ($app) {
                /**
                 * @var $auth AuthManager
                 */
                $auth = $app->make(AuthManager::class);
                return $auth->guard(config('admin.guard'));
            },
            true
        );

        $this->app->bindIf(
            \Erik\AdminManager\Contracts\AdminRouteManager::class,
            AdminRouteManager::class,
            true
        );

        $this->app->bindIf(
            \Erik\AdminManager\Contracts\AdminViewManager::class,
            AdminViewManager::class,
            true
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
