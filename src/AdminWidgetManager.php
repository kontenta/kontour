<?php

namespace Kontenta\Kontour;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminWidget;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Contracts\AdminWidgetManager as WidgetManagerContract;

class AdminWidgetManager implements WidgetManagerContract
{
    /**
     * @var Collection
     */
    private $widgets;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * @var AdminViewManager
     */
    private $viewManager;

    public function __construct(AdminViewManager $viewManager, Guard $guard)
    {
        $this->widgets = new Collection();
        $this->viewManager = $viewManager;
        $this->guard = $guard;
    }

    public function addWidget(AdminWidget $widget, string $desiredSectionName = null): WidgetManagerContract
    {
        if(empty($desiredSectionName))
        {
            $desiredSectionName = $this->viewManager->widgetSection();
        }

        if(!$this->widgets->has($desiredSectionName)) {
            $this->widgets->put($desiredSectionName, new Collection());
        }

        $this->widgets->get($desiredSectionName)->push($widget);

        return $this;
    }

    public function getAllWidgets(): Collection
    {
        return $this->widgets->flatten();
    }

    public function getWidgetsForSection(string $sectionName): Collection
    {
        return $this->widgets->get($sectionName, new Collection())->filter(function(AdminWidget $widget) {
            return $widget->isAuthorized($this->guard->user());
        });
    }
}
