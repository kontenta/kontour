<?php

namespace Kontenta\KontourSupport\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Contracts\UserAccountWidget as UserAccountWidgetContract;

class UserAccountWidget implements UserAccountWidgetContract
{
    public function toHtml()
    {
        $user = Auth::guard(config('kontour.guard'))->user();
        return View::make('kontour::widgets.userAccount', compact('user'))->render();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return (bool) $user;
    }
}
