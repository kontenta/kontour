<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Kontenta\Kontour\Contracts\AdminWidget as AdminWidgetContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

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
