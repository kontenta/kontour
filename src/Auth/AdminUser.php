<?php

namespace Kontenta\Kontour\Auth;

use Illuminate\Notifications\Notifiable;
use Kontenta\Kontour\Auth\Passwords\CanResetPassword;
use Kontenta\Kontour\Contracts\AdminUser as AdminUserContract;

class AdminUser extends \Illuminate\Foundation\Auth\User implements AdminUserContract
{
    use Notifiable, CanResetPassword;

    public function getDisplayName() : string
    {
        return $this->getEmailForPasswordReset();
    }
}
