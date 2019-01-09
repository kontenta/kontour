<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\MenuWidget as MenuWidgetContract;

class MenuWidget implements MenuWidgetContract
{
    use ResolvesAdminUser;

    /**
     * @var Collection
     */
    protected $links;

    public function __construct()
    {
        $this->links = new Collection();
        foreach (config('kontour.menu_heading_order', []) as $heading) {
            $this->links->put($heading, new Collection());
        }
    }

    public function toHtml()
    {
        return View::make('kontour::widgets.menu', ['links' => $this->authorizedLinks()])->render();
    }

    public function addLink(AdminLink $link, string $desiredHeading = null): MenuWidgetContract
    {
        if (empty($desiredHeading)) {
            $desiredHeading = 'main';
        }

        $headingNames = config('kontour.menu_heading_names', []);
        if (isset($headingNames[$desiredHeading])) {
            $desiredHeading = $headingNames[$desiredHeading];
        }

        $itemHeadings = config('kontour.menu_item_headings', []);
        if (isset($itemHeadings[$link->getName()])) {
            $desiredHeading = $itemHeadings[$link->getName()];
        }

        if (!$this->links->has($desiredHeading)) {
            $this->links->put($desiredHeading, new Collection());
        }

        $this->links[$desiredHeading] = $this->links[$desiredHeading]->push($link)->sortBy(function ($link, $key) {
            $menuItemOrder = config('kontour.menu_item_order', []);
            $place = array_search($link->getName(), $menuItemOrder);
            return is_int($place) ? $place - count($menuItemOrder) : $key;
        })->values();

        return $this;
    }

    public function getHeadings(): Collection
    {
        return $this->links->keys();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return (bool) $user;
    }

    protected function authorizedLinks()
    {
        return $this->links->map(function ($links) {
            return $links->filter->isAuthorized($this->adminUser());
        });
    }
}
