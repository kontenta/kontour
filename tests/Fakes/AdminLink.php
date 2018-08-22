<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;
use Kontenta\Kontour\Concerns\AuthorizesWithAbility as AuthorizesWithAbilityTrait;

class AdminLink implements AdminLinkContract, AuthorizesWithAbilityContract
{
    use AuthorizesWithAbilityTrait;

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

    public function toHtml(): string
    {
        return '';
    }
}
