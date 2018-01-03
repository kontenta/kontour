<?php

namespace Erik\AdminManagerImplementation;

use Erik\AdminManager\Contracts\ViewManager as ViewManagerContract;
use Illuminate\Support\Collection;

class ViewManager implements ViewManagerContract
{

    /**
     * Blade layout that admin views should extend
     * @return string
     */
    public function getLayout(): string
    {
        return 'admin::layouts.master';
    }

    /**
     * List of Blade section names provided in the layout
     * @return Collection
     */
    public function getLayoutSectionNames(): Collection
    {
        // TODO: Implement getLayoutSectionNames() method.
    }

    /**
     * List of Blade sections suitable for widgets
     * @return Collection
     */
    public function getWidgetSectionNames(): Collection
    {
        // TODO: Implement getWidgetSectionNames() method.
    }

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return ViewManagerContract
     */
    public function addStylesheetUrl(string ...$url): ViewManagerContract
    {
        // TODO: Implement addStylesheetUrl() method.
    }

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     * @return ViewManagerContract
     */
    public function addJavascriptUrl(string ...$url): ViewManagerContract
    {
        // TODO: Implement addJavascriptUrl() method.
    }

    /**
     * All registered stylesheets for the layout
     * @return Collection
     */
    public function getStylesheetUrls(): Collection
    {
        // TODO: Implement getStylesheetUrls() method.
    }

    /**
     * All registered javascripts for the layout
     * @return Collection
     */
    public function getJavascriptUrls(): Collection
    {
        // TODO: Implement getJavascriptUrls() method.
    }
}
