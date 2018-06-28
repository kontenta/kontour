<?php

namespace Kontenta\KontourImplementation\Auth;

use Kontenta\KontourImplementation\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class AdminUser extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
