<?php

namespace Kontenta\AdminManagerImplementation\Auth;

use Kontenta\AdminManagerImplementation\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class AdminUser extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
