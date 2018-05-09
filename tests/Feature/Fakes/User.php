<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Erik\AdminManagerImplementation\Concerns\CanResetPassword;

class User extends \Illuminate\Foundation\Auth\User
{
    use CanResetPassword;
}
