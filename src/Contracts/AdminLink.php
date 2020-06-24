<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface AdminLink extends Authorizes, Htmlable
{
    public function getUrl(): ?string;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getLabel(): string;

    /**
     * Set description fluently
     * @param string $description
     * @return $this
     */
    public function withDescription(string $description = null): AdminLink;
}
