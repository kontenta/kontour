<?php

namespace Kontenta\Kontour\Contracts;

interface ItemHistoryWidget extends AdminWidget
{
    /**
     * Add an entry to an item's history
     * @param AdminUser $user
     * @param \DateTimeImmutable $datetime
     * @param string $action
     */
    public function addEntry(AdminUser $user, \DateTimeImmutable $datetime, string $action = null): ItemHistoryWidget;
}
