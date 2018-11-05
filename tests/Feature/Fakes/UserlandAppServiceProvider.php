<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Support\ServiceProvider;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget;

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
        $this->registerWidgets();
        $this->registerCss();
    }

    protected function registerWidgets()
    {
        $this->registerAdminWidget($this->app->make(PersonalRecentVisitsWidget::class));
        $this->registerAdminWidget($this->app->make(TeamRecentVisitsWidget::class));
    }

    protected function registerCss()
    {
        $this->app->make(AdminViewManager::class)->addStylesheetUrl(url('admin.css'));
    }
}
