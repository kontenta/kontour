<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Kontenta\KontourSupport\RouteAdminLink;
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
        $this->addMenuLink();
    }

    protected function registerRoutes()
    {
        $this->registerAdminRoutes(function ($router) {
            $router->group([
                'prefix' => 'userland-tool',
                'namespace' => 'Kontenta\KontourSupport\Tests\Feature\Fakes',
            ], function ($router) {
                $router->get('/', 'UserlandController@index')->name('userland.index');
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

    protected function addMenuLink()
    {
        $routeName = 'userland.index';
        $name = 'Userland Tool';
        $link = new RouteAdminLink($routeName, $name);
        $this->app->make(\Kontenta\Kontour\Contracts\MenuWidget::class)->addLink($link);
    }
}
