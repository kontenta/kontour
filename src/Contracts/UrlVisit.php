<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Auth\Access\Authorizable;

interface UrlVisit
{
    public function getLink(): AdminLink;

    public function getUser(): Authorizable;

    public function getDateTime(): \DateTimeImmutable;
}
