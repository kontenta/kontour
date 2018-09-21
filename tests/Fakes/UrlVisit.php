<?php

namespace Kontenta\Kontour\Tests\Fakes;

use Kontenta\Kontour\Contracts\UrlVisit as UrlVisitContract;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\AdminUser;

class UrlVisit implements UrlVisitContract
{
    public function getLink(): AdminLinkContract
    {
        return new AdminLink();
    }

    public function getUser(): AdminUser
    {
        return new Illuminate\Auth\GenericUser();
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
