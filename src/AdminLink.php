<?php

namespace Kontenta\Kontour;

use Kontenta\Kontour\Concerns\AuthorizesWithAbility as AuthorizesWithAbilityTrait;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;

class AdminLink implements AdminLinkContract, AuthorizesWithAbilityContract
{
    use AuthorizesWithAbilityTrait;

    protected $name;
    protected $url;
    protected $description;

    public function __construct(string $name, string $url, string $description = null)
    {
        $this->name = $name;
        $this->url = $url;
        $this->withDescription($description);
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description fluently
     * @param string $description
     * @return $this
     */
    public function withDescription(string $description = null): AdminLinkContract
    {
        $this->description = $description;

        return $this;
    }

    public function toHtml(): string
    {
        $attributes = [];

        if ($this->getUrl()) {
            $attributes[] = 'href="' . htmlspecialchars($this->getUrl()) . '"';
        }

        if ($this->getDescription()) {
            $attributes[] = 'title="' . htmlspecialchars($this->getDescription()) . '"';
        }

        return '<a ' . implode(' ', $attributes) . '>' . $this->getName() . '</a>';
    }
}
