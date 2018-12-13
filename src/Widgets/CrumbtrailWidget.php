<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\CrumbtrailWidget as CrumbtrailWidgetContract;

class CrumbtrailWidget implements CrumbtrailWidgetContract
{
    use ResolvesAdminUser;

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
        if ($this->links->count() > 1) {
            return View::make('kontour::widgets.crumbtrail', ['links' => $this->authorizedLinks()])->render();
        }
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

    protected function authorizedLinks()
    {
        return $this->links->filter->isAuthorized($this->adminUser());
    }
}
