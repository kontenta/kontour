<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Foundation\Auth\Access\Authorizable;

interface Authorizes
{
    /**
     * Checks if a user is authorized to interact with an object
     * @param Authorizable $user
     * @return bool
     */
    public function isAuthorized(Authorizable $user = null): bool;
}
