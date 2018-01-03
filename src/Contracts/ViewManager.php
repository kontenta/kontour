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
     * List of Blade section names provided in the layout
     * @return Collection
     */
    public function getLayoutSectionNames(): Collection;

    /**
     * List of Blade sections suitable for widgets
     * @return Collection
     */
    public function getWidgetSectionNames(): Collection;

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
