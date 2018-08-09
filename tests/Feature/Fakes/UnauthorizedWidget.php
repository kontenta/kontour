<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget;

class UnauthorizedWidget implements AdminWidget
{
    public function toHtml()
    {
        return "<div>UnauthorizedWidget</div>";
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return false;
    }
}
