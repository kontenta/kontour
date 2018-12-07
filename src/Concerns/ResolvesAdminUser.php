<?php

namespace Kontenta\Kontour\Concerns;

use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Contracts\AdminUser;

trait ResolvesAdminUser
{
    /**
     * Get the currently logged in admin user
     * @return Kontenta\Kontour\Contracts\AdminUser
     */
    public function user()
    {
        return Auth::guard(config('kontour.guard'))->user();
    }
}
