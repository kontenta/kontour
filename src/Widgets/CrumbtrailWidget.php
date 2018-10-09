<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\CrumbtrailWidget as CrumbtrailWidgetContract;
use Kontenta\Kontour\Contracts\AdminLink;
use Illuminate\Support\Facades\View;

class CrumbtrailWidget implements CrumbtrailWidgetContract
{
    /**
     * @var Collection
     */
    protected $links;

    public function __construct()
    {
        $this->links = new Collection();
    }

    public function toHtml()
    {
        return View::make('kontour::widgets.crumbtrail', ['links' => $this->links])->render();
    }

    public function addLink(AdminLink $link): CrumbtrailWidgetContract
    {
        $this->links->push($link);

        return $this;
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
