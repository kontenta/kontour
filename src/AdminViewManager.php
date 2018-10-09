<?php

namespace Kontenta\KontourSupport;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminViewManager as ViewManagerContract;

class AdminViewManager implements ViewManagerContract
{

    /**
     * Blade layout that admin views should extend
     * @return string
     */
    public function layout(): string
    {
        return config('kontour.layout', 'kontour::layouts.master');
    }

    /**
     * Name of the main content blade section
     * @return string
     */
    public function mainSection(): string
    {
        return config('kontour.sections.main', 'main');
    }

    /**
     * Name of the navigation blade section
     * @return string
     */
    public function navSection(): string
    {
        return config('kontour.sections.nav', 'nav');
    }

    /**
     * Name of the main widget blade section
     * @return string
     */
    public function widgetSection(): string
    {
        return config('kontour.sections.widgets', 'widgets');
    }

    /**
     * Name of the main header blade section
     * @return string
     */
    public function headerSection(): string
    {
        return config('kontour.sections.header', 'header');
    }

    /**
     * Name of the main footer blade section
     * @return string
     */
    public function footerSection(): string
    {
        return config('kontour.sections.footer', 'footer');
    }

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addStylesheetUrl(string...$url): ViewManagerContract
    {
        // TODO: Implement addStylesheetUrl() method.
        return $this;
    }

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addJavascriptUrl(string...$url): ViewManagerContract
    {
        // TODO: Implement addJavascriptUrl() method.
        return $this;
    }

    /**
     * All registered stylesheets for the layout
     * @return Collection
     */
    public function getStylesheetUrls(): Collection
    {
        // TODO: Implement getStylesheetUrls() method.
        return collect();
    }

    /**
     * All registered javascripts for the layout
     * @return Collection
     */
    public function getJavascriptUrls(): Collection
    {
        // TODO: Implement getJavascriptUrls() method.
        return collect();
    }
}
