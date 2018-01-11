<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Erik\AdminManager\Contracts\AdminRouteManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserlandServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
    }

    protected function registerRoutes(): void
    {
        /** @var AdminRouteManager $adminRouteManager */
        $adminRouteManager = $this->app->make(AdminRouteManager::class);
        $adminRouteManager->registerRoutes(function () {
            Route::group([
                'prefix' => 'userland-tool',
                'namespace' => 'Erik\AdminManagerImplementation\Tests\Feature\Fakes'
            ], function () {
                Route::get('/', 'UserlandController@index')->name('userland.index');
            });
        });
    }

    /**
     * Register the resources.
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'userland');
    }
}
