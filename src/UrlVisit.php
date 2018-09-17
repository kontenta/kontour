<?php

namespace Kontenta\KontourSupport;

use Kontenta\Kontour\Contracts\UrlVisit as UrlVisitContract;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Illuminate\Contracts\Auth\Access\Authorizable;

class UrlVisit implements UrlVisitContract
{
    private $link;
    private $user;
    private $datetime;

    public function __construct(AdminLink $link, Authorizable $user)
    {
        $this->link = $link;
        $this->user = $user;
        $this->datetime = new \DateTimeImmutable();
    }

    public function getLink(): AdminLinkContract
    {
        return $this->link;
    }

    public function getUser(): Authorizable
    {
        return $this->user;
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return $this->datetime;
    }
}

