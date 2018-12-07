<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\Contracts\UserAccountWidget as UserAccountWidgetContract;

class UserAccountWidget implements UserAccountWidgetContract
{
    use ResolvesAdminUser;

    public function toHtml()
    {
        return View::make('kontour::widgets.userAccount', ['user' => $this->user()])->render();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return (bool) $user;
    }
}
