<?php

namespace Kontenta\Kontour;

use Kontenta\Kontour\Contracts\AdminVisit as AdminVisitContract;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\AdminUser;
use Illuminate\Queue\SerializesModels;

abstract class AdminVisit implements AdminVisitContract
{
    use SerializesModels;

    protected $link;
    protected $user;
    protected $datetime;

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
