<?php

namespace Kontenta\Kontour\Concerns;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Guard;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;

trait AuthorizesWithAbility
{
    private $authorizesWithAbilityPolicyOrGate;
    private $authorizesWithAbilityArguments;
    private $authorizesWithAbilityGuard;

    /**
     * Register a policy or gate to be used for the authorization
     * @param string $policyOrGate
     * @param $arguments
     * @return $this
     */
    public function registerAbilityForAuthorization(string $policyOrGate, $arguments = []): AuthorizesWithAbilityContract
    {
        $this->authorizesWithAbilityPolicyOrGate = $policyOrGate;
        $this->authorizesWithAbilityArguments = $arguments;

        return $this;
    }

    /**
     * Register a guard to be used for the authorization
     * @param Guard $guard
     * @return $this
     */
    public function registerGuardForAuthorization(Guard $guard): AuthorizesWithAbilityContract
    {
        $this->authorizesWithAbilityGuard = $guard;
        return $this;
    }

    /**
     * Checks if a user is authorized to interact with an object
     * @param Authorizable $user
     * @return bool
     */
    public function isAuthorized(Authorizable $user = null): bool
    {
        if ($this->authorizesWithAbilityGuard) {
            $user = $this->authorizesWithAbilityGuard->user();
        }

        if (!$user) {
            return false;
        }

        return $user->can($this->authorizesWithAbilityPolicyOrGate, ...$this->authorizesWithAbilityArguments);
    }
}
