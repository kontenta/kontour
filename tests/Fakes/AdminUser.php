<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Kontenta\Kontour\Contracts\AdminUser as AdminUserContract;

class AdminUser extends \Illuminate\Foundation\Auth\User implements AdminUserContract
{
    public function getDisplayName(): string
    {
        return 'ollebolle';
    }
}
