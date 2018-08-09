<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Kontenta\Kontour\Concerns\RegistersAdminRoutes;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;

class UserlandServiceProvider extends ServiceProvider
{
    use RegistersAdminRoutes, RegistersAdminWidgets;

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
        $this->registerWidgets();
    }

    protected function registerRoutes()
    {
        $this->registerAdminRoutes(function () {
            Route::group([
                'prefix' => 'userland-tool',
                'namespace' => 'Kontenta\KontourSupport\Tests\Feature\Fakes',
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

    protected function registerWidgets()
    {
        $this->registerAdminWidget(new UserlandAdminWidget());
        $this->registerAdminWidget(new UnauthorizedWidget());
    }
}
