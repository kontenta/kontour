<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Kontenta\Kontour\Contracts\AdminWidget;
use Illuminate\Foundation\Auth\Access\Authorizable;

class UserlandAdminWidget implements AdminWidget
{
    public function toHtml()
    {
        return "<div>UserlandAdminWidget</div>";
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
