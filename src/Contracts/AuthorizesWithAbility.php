<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Auth\Guard;

interface AuthorizesWithAbility extends Authorizes
{
    /**
     * Register a policy or gate to be used for the authorization
     * @param string $ability name from a Gate/Policy
     * @param array|mixed $arguments for the ability check, typically a model instance
     * @return $this
     */
    public function registerAbilityForAuthorization(string $ability, $arguments = []): AuthorizesWithAbility;

    /**
     * Register a guard to be used for the authorization
     * @param string $guard
     * @return $this
     */
    public function registerGuardForAuthorization(string $guard): AuthorizesWithAbility;
}
