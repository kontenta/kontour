<?php

namespace Kontenta\KontourSupport;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\MenuWidget as MenuWidgetContract;
use Kontenta\Kontour\Contracts\AdminLink;

class MenuWidget implements MenuWidgetContract
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
        return '<ul>'.$this->links->map(function ($links, $heading) {
            return '<li><span>'.$heading.'</span><ul>'.$links->map(function ($link) {
                return '<li>'.$link->toHtml().'</li>';
            })->implode("\n").'</ul></li>';
        })->implode("\n").'</ul>';
    }

    public function addLink(AdminLink $link, string $desiredHeading = null): MenuWidgetContract
    {
        if(empty($desiredHeading))
        {
            $desiredHeading = 'main';
        }

        if(!$this->links->has($desiredHeading)) {
            $this->links->put($desiredHeading, new Collection());
        }

        $this->links->get($desiredHeading)->push($link);

        return $this;
    }

    public function getHeadings(): Collection
    {
        return $this->links->keys();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
