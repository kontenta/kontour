<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Support\ServiceProvider;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget;
use Illuminate\Support\Facades\Gate;

class UserlandAppServiceProvider extends ServiceProvider
{
    use RegistersAdminWidgets;

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
        $this->registerGates();
        $this->registerWidgets();
        $this->registerCss();
        $this->registerJs();
    }

    protected function registerGates()
    {
        Gate::define('access userland tool', function ($user) {
            return true;
        });
    }

    protected function registerWidgets()
    {
        $this->findOrRegisterAdminWidget(PersonalRecentVisitsWidget::class);
        $this->findOrRegisterAdminWidget(TeamRecentVisitsWidget::class);
    }

    protected function registerCss()
    {
        $this->app->make(AdminViewManager::class)->addStylesheetUrl(url('admin.css'));
    }

    protected function registerJs()
    {
        $this->app->make(AdminViewManager::class)->addJavascriptUrl(url('admin.js'));
        $this->app->make(AdminViewManager::class)->addJavascriptUrl('https://cdn.example.com/framework.js');
    }
}
