<?php

namespace Kontenta\KontourSupport\Auth;

use Illuminate\Notifications\Notifiable;
use Kontenta\KontourSupport\Auth\Passwords\CanResetPassword;
use Kontenta\Kontour\Contracts\AdminUser as AdminUserContract;

class AdminUser extends \Illuminate\Foundation\Auth\User implements AdminUserContract
{
    use Notifiable, CanResetPassword;

    public function getDisplayName() : string 
    {
        return $this->getEmailForPasswordReset();
    }
}
