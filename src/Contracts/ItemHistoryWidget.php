<?php

namespace Kontenta\Kontour\Contracts;

interface ItemHistoryWidget extends AdminWidget
{
    /**
     * Add an entry to an item's history
     * @return $this
     */
    public function addEntry(string $action, \DateTime $datetime, AdminUser $user = null): ItemHistoryWidget;
    
    /**
     * Add a create entry to an item's history
     * @return $this
     */
    public function addCreatedEntry(\DateTime $datetime, AdminUser $user = null): ItemHistoryWidget;
    
    /**
     * Add an update entry to an item's history
     * @return $this
     */
    public function addUpdatedEntry(\DateTime $datetime, AdminUser $user = null): ItemHistoryWidget;
}
