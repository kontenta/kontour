<?php

namespace Kontenta\Kontour\Concerns;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;

trait AuthorizesWithAbility
{
    use SerializesModels; //If $authorizesWithAbilityArguments is just a single Eloquent model, this will serialize it. (But not if it's an array unfortunately)

    private $authorizesWithAbilityName;
    private $authorizesWithAbilityArguments;
    private $authorizesWithAbilityGuard;

     /**
     * Register a policy or gate to be used for the authorization
     * @param string $ability name from a Gate/Policy
     * @param array|mixed $arguments for the ability check, typically a model instance
     * @return $this
     */
    public function registerAbilityForAuthorization(string $ability, $arguments = []): AuthorizesWithAbilityContract
    {
        $this->authorizesWithAbilityName = $ability;
        $this->authorizesWithAbilityArguments = $arguments;

        return $this;
    }

    /**
     * Register a guard to be used for the authorization
     * @param string $guard
     * @return $this
     */
    public function registerGuardForAuthorization(string $guard): AuthorizesWithAbilityContract
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
        try {
            if ($this->authorizesWithAbilityGuard) {
                $user = Auth::guard($this->authorizesWithAbilityGuard)->user();
            }
        } catch (\Exception $e) {
            // Something is wrong with the guard... perhaps it no longer exists?
            return false;
        }

        if (!$user instanceof Authorizable) {
            return false;
        }

        return $user->can($this->authorizesWithAbilityName, $this->authorizesWithAbilityArguments);
    }
}
