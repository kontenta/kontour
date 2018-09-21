<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

interface AdminUser extends AuthenticatableContract, AuthorizableContract
{
    public function getDisplayName(): string;
}
