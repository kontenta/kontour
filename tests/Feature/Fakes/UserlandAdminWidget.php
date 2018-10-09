<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget;

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
