<?php

namespace Kontenta\KontourSupport;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminWidget;
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

    public function __construct(Guard $guard)
    {
        $this->widgets = new Collection();
        $this->guard = $guard;
    }

    public function addWidget(AdminWidget $widget, string $desiredSectionName = null): WidgetManagerContract
    {
        $this->widgets->push($widget);

        return $this;
    }

    public function getAllWidgets(): Collection
    {
        return $this->widgets;
    }

    public function getWidgetsForSection(string $sectionName): Collection
    {
        return $this->widgets->filter(function(AdminWidget $widget) {
            return $widget->isAuthorized($this->guard->user());
        });
    }
}
