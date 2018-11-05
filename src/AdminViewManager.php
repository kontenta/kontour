<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminViewManager as ViewManagerContract;

class AdminViewManager implements ViewManagerContract
{
    /**
     * @var Collection
     */
    protected $stylesheets;

    public function __construct()
    {
        $this->stylesheets = new Collection();
    }

    /**
     * Blade layout that admin views should extend
     * @return string
     */
    public function layout(): string
    {
        return config('kontour.layout', 'kontour::layouts.master');
    }

    /**
     * Blade layout that admin tool views could extend
     * @return string
     */
    public function toolLayout(): string
    {
        return config('kontour.toolLayout', 'kontour::layouts.tool');
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
     * Name of the tool header blade section
     * @return string
     */
    public function toolHeaderSection(): string
    {
        return config('kontour.sections.toolHeader', 'toolHeader');
    }

    /**
     * Name of the tool main blade section
     * @return string
     */
    public function toolMainSection(): string
    {
        return config('kontour.sections.toolMain', 'toolMain');
    }

    /**
     * Name of the tool widget blade section
     * @return string
     */
    public function toolWidgetSection(): string
    {
        return config('kontour.sections.toolWidget', 'toolWidget');
    }

    /**
     * Name of the tool footer blade section
     * @return string
     */
    public function toolFooterSection(): string
    {
        return config('kontour.sections.toolFooter', 'toolFooter');
    }

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addStylesheetUrl(string...$url): ViewManagerContract
    {
        foreach($url as $newUrl)
        {
            if(!$this->stylesheets->contains(function ($value, $key) use ($newUrl) {
                return url($value) == url($newUrl);
            })) {
                $this->stylesheets->push($newUrl);
            }
        }

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
        return $this->stylesheets;
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
