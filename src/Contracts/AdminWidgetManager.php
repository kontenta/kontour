<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Support\Collection;

interface AdminWidgetManager
{
    /**
     * Add an AdminWidget to the layout, with the option to specify in what section the widget should appear
     * @param AdminWidget $widget
     * @param string $desiredSectionName
     * @return $this
     */
    public function addWidget(AdminWidget $widget, string $desiredSectionName = null): AdminWidgetManager;

    /**
     * All registered AdminWidgets for the layout
     * @return Collection
     */
    public function getAllWidgets(): Collection;

    /**
     * All registered AdminWidgets for a specific section
     * @return Collection
     */
    public function getWidgetsForSection(string $sectionName): Collection;
}
