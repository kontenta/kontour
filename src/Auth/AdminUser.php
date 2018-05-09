<?php

namespace Erik\AdminManagerImplementation\Auth;

use Erik\AdminManagerImplementation\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class AdminUser extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
