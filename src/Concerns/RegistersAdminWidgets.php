<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\Contracts\AdminWidget;

/**
 * Trait RegistersAdminWidgets
 * @property \Illuminate\Foundation\Application $app
 */
trait RegistersAdminWidgets
{
    /**
     * Add an AdminWidget to the layout, with the option to specify in what section the widget should appear
     * @param AdminWidget $widget
     * @param string $desiredSectionName
     */
    public function registerAdminWidget(AdminWidget $widget, string $desiredSectionName = null)
    {
        $this->resolveAdminWidgetManager()->addWidget($widget, $desiredSectionName);
    }

    protected function resolveAdminWidgetManager(): \Kontenta\Kontour\Contracts\AdminWidgetManager
    {
        return app(\Kontenta\Kontour\Contracts\AdminWidgetManager::class);
    }
}
