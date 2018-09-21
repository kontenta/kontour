<?php

namespace Kontenta\KontourSupport;

use Kontenta\Kontour\Contracts\UrlVisit as UrlVisitContract;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\AdminUser;
use Illuminate\Queue\SerializesModels;

class UrlVisit implements UrlVisitContract
{
    use SerializesModels;

    private $link;
    private $user;
    private $datetime;

    public function __construct(AdminLink $link, AdminUser $user)
    {
        $this->link = $link;
        $this->user = $user;
        $this->datetime = new \DateTimeImmutable();
    }

    public function getLink(): AdminLink
    {
        return $this->link;
    }

    public function getUser(): AdminUser
    {
        return $this->user;
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return $this->datetime;
    }
}

