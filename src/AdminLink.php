<?php

namespace Kontenta\KontourSupport;

use Kontenta\Kontour\Concerns\AuthorizesWithAbility as AuthorizesWithAbilityTrait;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;

class AdminLink implements AdminLinkContract, AuthorizesWithAbilityContract
{
    use AuthorizesWithAbilityTrait;

    private $url;
    private $name;
    private $description;

    public function __construct(string $url, string $name, string $description = null)
    {
        $this->url = $url;
        $this->name = $name;
        $this->description = $description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function toHtml(): string
    {
        return sprintf('<a href="%s" title="%s">%s</a>',
            htmlspecialchars($this->getUrl()),
            htmlspecialchars($this->getDescription()),
            $this->getName()
        );
    }
}
