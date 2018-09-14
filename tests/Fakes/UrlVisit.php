<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Kontenta\Kontour\Contracts\UrlVisit as UrlVisitContract;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Illuminate\Contracts\Auth\Access\Authorizable;

class UrlVisit implements UrlVisitContract
{
    public function getLink(): AdminLinkContract
    {
        return new AdminLink();        
    }

    public function getUser(): Authorizable
    {
        return new Illuminate\Auth\GenericUser();
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
