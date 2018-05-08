<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Erik\AdminManager\Concerns\RegistersAdminRoutes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserlandServiceProvider extends ServiceProvider
{
    use RegistersAdminRoutes;

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

    protected function registerRoutes()
    {
        $this->registerAdminRoutes(function () {
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
