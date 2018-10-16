<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Support\ServiceProvider;
use Kontenta\Kontour\Concerns\RegistersAdminRoutes;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Concerns\RegistersMenuWidgetLinks;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget;

class UserlandServiceProvider extends ServiceProvider
{
    use RegistersAdminRoutes, RegistersAdminWidgets, RegistersMenuWidgetLinks;

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
        $this->registerMenuLinks();
    }

    protected function registerRoutes()
    {
        $this->registerAdminRoutes(function ($router) {
            $router->group([
                'prefix' => 'userland-tool',
                'namespace' => 'Kontenta\Kontour\Tests\Feature\Fakes',
            ], function ($router) {
                $router->get('/', 'UserlandController@index')->name('userland.index');
                $router->get('edit/{id}', 'UserlandController@edit')->name('userland.edit');
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
        $this->registerAdminWidget($this->app->make(PersonalRecentVisitsWidget::class));
        $this->registerAdminWidget($this->app->make(TeamRecentVisitsWidget::class));
    }

    protected function registerMenuLinks()
    {
        $routeName = 'userland.index';
        $name = 'Userland Tool';
        $this->addMenuWidgetRoute($routeName, $name);
    }
}
