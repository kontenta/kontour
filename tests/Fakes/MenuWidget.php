<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\MenuWidget as MenuWidgetContract;

class MenuWidget implements MenuWidgetContract
{
    public function toHtml()
    {
        return '';
    }

    public function addLink(AdminLink $link, string $desiredHeading = null): MenuWidgetContract
    {
        return $this;
    }

    public function getHeadings(): Collection
    {
        return new Collection();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
