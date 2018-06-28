<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Support\Collection;

interface AdminViewManager
{
    /**
     * Blade layout that admin views should extend
     * @return string
     */
    public function layout(): string;

    /**
     * Name of the main content blade section
     * @return string
     */
    public function mainSection(): string;

    /**
     * Name of the main widget blade section
     * @return string
     */
    public function widgetSection(): string;

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     */
    public function addStylesheetUrl(string ...$url);

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     */
    public function addJavascriptUrl(string ...$url);

    /**
     * All registered stylesheets for the layout
     * @return Collection
     */
    public function getStylesheetUrls(): Collection;

    /**
     * All registered javascripts for the layout
     * @return Collection
     */
    public function getJavascriptUrls(): Collection;
}
