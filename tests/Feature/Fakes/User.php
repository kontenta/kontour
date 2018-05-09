<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Erik\AdminManagerImplementation\Concerns\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, CanResetPassword;
}
