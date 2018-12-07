<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Contracts\UserAccountWidget as UserAccountWidgetContract;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;

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
