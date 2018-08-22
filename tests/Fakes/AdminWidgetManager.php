<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminWidgetManager as AdminWidgetManagerContract;
use Kontenta\Kontour\Contracts\AdminWidget;

class AdminWidgetManager implements AdminWidgetManagerContract
{
    public function addWidget(AdminWidget $widget, string $desiredSectionName = null): AdminWidgetManagerContract
    {
        return $this;
    }

    public function getAllWidgets(): Collection
    {
        return new Collection();
    }

    public function getWidgetsForSection(string $sectionName): Collection
    {
        return new Collection();
    }
}
