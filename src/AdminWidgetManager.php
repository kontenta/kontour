<?php

namespace Kontenta\Kontour;

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
        if (empty($desiredSectionName)) {
            $desiredSectionName = 'kontourWidgets';
        }

        if (!$this->widgets->has($desiredSectionName)) {
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
        return $this->widgets->get($sectionName, new Collection())->filter(function (AdminWidget $widget) {
            return $widget->isAuthorized($this->guard->user());
        });
    }
}
