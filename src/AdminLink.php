<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\AuthorizesWithAbility as AuthorizesWithAbilityTrait;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AuthorizesWithAbility as AuthorizesWithAbilityContract;
use Illuminate\Support\Str;

class AdminLink implements AdminLinkContract, AuthorizesWithAbilityContract
{
    use AuthorizesWithAbilityTrait;

    protected $name;
    protected $url;
    protected $description;
    protected $view = 'kontour::adminlinks.adminlink';

    public function __construct(string $name, string $url, string $description = null)
    {
        $this->name = $name;
        $this->url = $url;
        $this->withDescription($description);
    }

    public static function create(...$args): AdminLink
    {
        return new static(...$args);
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
        return trim(strip_tags($this->description));
    }

    public function getLabel(): string
    {
        $name = trim(strip_tags($this->name));
        $description = trim(strip_tags($this->description));

        if (Str::contains($description, $name)) {
            return $description;
        }

        return implode(' | ', array_filter([$name, $description]));
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

    /**
     * Set the view to use with the toHtml-function fluently
     * @param string $view
     * @return $this
     */
    public function withView(string $view): AdminLinkContract
    {
        $this->view = $view;

        return $this;
    }

    public function toHtml(): string
    {
        return trim(View::make($this->view, ['link' => $this])->render());
    }
}
