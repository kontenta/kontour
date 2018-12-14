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

    /**
     * @var Collection
     */
    protected $javascripts;

    public function __construct()
    {
        $this->stylesheets = new Collection();
        $this->javascripts = new Collection();
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
     * Add a stylesheet that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addStylesheetUrl(string...$url): ViewManagerContract
    {
        $this->addToCollection('stylesheets', $url);

        return $this;
    }

    /**
     * Add a javascript that the layout should pull in
     * @param string[] ...$url
     * @return $this
     */
    public function addJavascriptUrl(string...$url): ViewManagerContract
    {
        $this->addToCollection('javascripts', $url);

        return $this;
    }

    /**
     * Add a url to a collection if the url is not already in the named collection
     */
    private function addToCollection(string $collectionName, array $url)
    {
        foreach ($url as $newUrl) {
            if (!$this->$collectionName->contains(function ($oldUrl) use ($newUrl) {
                return url($oldUrl) == url($newUrl);
            })) {
                $this->$collectionName->push($newUrl);
            }
        }
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
        return $this->javascripts;
    }
}
