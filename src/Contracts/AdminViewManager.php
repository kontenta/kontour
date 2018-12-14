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
     * Blade layout that admin tool views could extend
     * @return string
     */
    public function toolLayout(): string;

    /**
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addStylesheetUrl(string ...$url): AdminViewManager;

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addJavascriptUrl(string ...$url): AdminViewManager;

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
