<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget;

class UserlandAdminWidget implements AdminWidget
{
    public function toHtml()
    {
        return "<section><header>Userland Widget</header><em>I can be anything!</em></section>";
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
