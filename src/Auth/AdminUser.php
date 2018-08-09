<?php

namespace Kontenta\KontourSupport\Auth;

use Illuminate\Notifications\Notifiable;
use Kontenta\KontourSupport\Auth\Passwords\CanResetPassword;

class AdminUser extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
