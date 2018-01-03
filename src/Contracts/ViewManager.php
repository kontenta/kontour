<?php

namespace Erik\AdminManager\Contracts;

use Illuminate\Support\Collection;

interface ViewManager
{
    /**
     * Blade layout that admin views should extend
     * @return string
     */
    public function getLayout(): string;

    /**
     * Name of the main content blade section
     * @return string
     */
    public function getMainSection(): string;

    /**
     * Name of the main widget blade section
     * @return string
     */
    public function getWidgetSection(): string;

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addStylesheetUrl(string ...$url): self;

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addJavascriptUrl(string ...$url): self;

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
