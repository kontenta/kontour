<?php

namespace Kontenta\Kontour\Contracts;

interface AdminVisit
{
    public function getLink(): AdminLink;

    public function getUser(): AdminUser;

    public function getDateTime(): \DateTimeImmutable;

    public function getType(): string;
}
