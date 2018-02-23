<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Illuminate\Notifications\Notifiable;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable;
}
