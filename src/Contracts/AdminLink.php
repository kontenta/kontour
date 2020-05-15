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

    /**
     * Get a new instance with prefixed name
     * @param string $prefix
     * @return AdminLink
     */
    public function startName(string $prefix): AdminLink;

    /**
     * Get a new instance with prefixed description
     * @param string $prefix
     * @return AdminLink
     */
    public function startDescription(string $prefix): AdminLink;
}
