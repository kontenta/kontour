<?php

namespace Erik\AdminManagerImplementation;

use Erik\AdminManager\Concerns\RegistersAdminRoutes;
use Erik\AdminManagerImplementation\Http\Middleware\RedirectIfAuthenticated;
use Erik\AdminManagerImplementation\Http\Middleware\AuthenticateAdmin;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\ServiceProvider;

//TODO: Move this file containing AdminManagerServiceProvider to src/Providers directory
class AdminManagerServiceProvider extends ServiceProvider
{
    use RegistersAdminRoutes;

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

        $this->app->bindIf(
            \Erik\AdminManager\Contracts\AdminAuthenticateMiddleware::class,
            AuthenticateAdmin::class
        );

        $this->app->bindIf(
            \Erik\AdminManager\Contracts\AdminGuestMiddleware::class,
            RedirectIfAuthenticated::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerResources();

        $this->registerRoutes();

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
     * Register views and other resources.
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
    }

    /**
     * Register the admin routes to index and auth
     */
    protected function registerRoutes()
    {
        $this->registerAdminRoutes(__DIR__ . '/../routes/admin.php');
        $this->registerAdminGuestRoutes(__DIR__ . '/../routes/auth.php');
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
