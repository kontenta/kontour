<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\Contracts\AdminWidget;

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

    /**
     * Get a registered AdminWidget by class or contract name, or register a new instance and return it
     * @param string $widgetContractName
     * @param string $desiredSectionName
     * @return AdminWidget
     */
    public function findOrRegisterAdminWidget(string $widgetContractName, string $desiredSectionName = null)
    {
        $widget = $this->resolveAdminWidgetManager()->getAllWidgets()->whereInstanceOf($widgetContractName)->first();
        if (!$widget) {
            $widget = app($widgetContractName);
            $this->registerAdminWidget($widget, $desiredSectionName);
        }

        return $widget;
    }

    protected function resolveAdminWidgetManager(): \Kontenta\Kontour\Contracts\AdminWidgetManager
    {
        return app(\Kontenta\Kontour\Contracts\AdminWidgetManager::class);
    }
}
