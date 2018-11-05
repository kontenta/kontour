<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Support\ServiceProvider;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Concerns\RegistersAdminRoutes;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\AdminBootManager;
use Kontenta\Kontour\Contracts\MenuWidget;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget;

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
        $this->findOrRegisterAdminWidget(PersonalRecentVisitsWidget::class);
        $this->findOrRegisterAdminWidget(TeamRecentVisitsWidget::class);
    }

    protected function registerMenuLinks()
    {
        $this->app->make(AdminBootManager::class)->beforeRoute(function (MenuWidget $menuWidget) {
            $menuWidget->addLink(AdminLink::create('Userland Tool', route('userland.index')));
            $menuWidget->addLink(AdminLink::create('External Link', 'http://external.com'), 'External');
        });
    }
}
