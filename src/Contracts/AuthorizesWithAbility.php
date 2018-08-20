<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Auth\Guard;

interface AuthorizesWithAbility extends Authorizes
{
    /**
     * Register a policy or gate to be used for the authorization
     * @param string $policyOrGate
     * @param $arguments
     * @return $this
     */
    public function registerAbilityForAuthorization(string $policyOrGate, $arguments = []): AuthorizesWithAbility;

    /**
     * Register a guard to be used for the authorization
     * @param Guard $guard
     * @return $this
     */
    public function registerGuardForAuthorization(Guard $guard): AuthorizesWithAbility;
}
