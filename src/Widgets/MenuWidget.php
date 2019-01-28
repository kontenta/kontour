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
        if (in_array($link->getName(), config('kontour.menu_hidden_items', []))) {
            return $this;
        }

        $heading = $this->headingForLink($link, $desiredHeading);

        if (!$this->links->has($heading)) {
            $this->links->put($heading, new Collection());
        }

        $this->links[$heading]->push($link);
        $this->sortLinksInHeading($heading);

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

    protected function headingForLink(AdminLink $link, string $desiredHeading = null)
    {
        $heading = trim($desiredHeading);

        if (empty($heading)) {
            $heading = 'main';
        }

        $headingNames = config('kontour.menu_heading_names', []);
        if (isset($headingNames[$heading])) {
            $heading = $headingNames[$heading];
        }

        $itemHeadings = config('kontour.menu_item_headings', []);
        if (isset($itemHeadings[$link->getName()])) {
            $heading = $itemHeadings[$link->getName()];
        }

        return $heading;
    }

    protected function sortLinksInHeading($heading)
    {
        $this->links[$heading] = $this->links[$heading]->sortBy(function ($link, $key) {
            $menuItemOrder = config('kontour.menu_item_order', []);
            $place = array_search($link->getName(), $menuItemOrder);
            return is_int($place) ? $place - count($menuItemOrder) : $key;
        })->values();
    }
}
