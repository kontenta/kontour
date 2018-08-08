<?php

namespace Kontenta\KontourSupport;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminWidget;
use Kontenta\Kontour\Contracts\AdminWidgetManager as WidgetManagerContract;

class AdminWidgetManager implements WidgetManagerContract
{
    /**
     * @var Collection
     */
    private $widgets;

    public function __construct()
    {
        $this->widgets = new Collection();
    }

    public function addWidget(AdminWidget $widget, string $desiredSectionName = null)
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
        return $this->widgets;
    }
}
