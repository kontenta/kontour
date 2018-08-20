<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Guard;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility;

class AdminLink implements AdminLinkContract, AuthorizesWithAbility
{
    public function getUrl(): string 
    {
        return '';
    }
    
    public function getName(): string
    {
        return '';
    }
    
    public function getDescription(): string
    {
        return '';
    }
    
    public function isAuthorized(Authorizable $user = null): bool 
    {
        return true;
    }
    
    public function registerAbilityForAuthorization(string $policyOrGate, $arguments = []): AuthorizesWithAbility
    {
        return $this;
    }
    
    public function registerGuardForAuthorization(Guard $guard): AuthorizesWithAbility
    {
        return $this;
    }
}
