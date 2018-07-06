<?php

namespace Kontenta\KontourSupport\Auth;

use Kontenta\KontourSupport\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class AdminUser extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
