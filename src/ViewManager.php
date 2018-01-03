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
        //TODO: pull the layout name from config
        return 'admin::layouts.master';
    }

    /**
     * Name of the main content blade section
     * @return string
     */
    public function getMainSection(): string
    {
        //TODO: pull main section name from config
        return 'main';
    }

    /**
     * Name of the main widget blade section
     * @return string
     */
    public function getWidgetSection(): string
    {
        //TODO: pull widget section from config
        return 'widgets';
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
