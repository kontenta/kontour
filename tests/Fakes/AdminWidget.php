<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget as AdminWidgetContract;

class AdminWidget implements AdminWidgetContract
{
    public function toHtml()
    {
        return '';
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
