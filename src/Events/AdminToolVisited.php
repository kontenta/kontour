<?php

namespace Kontenta\Kontour\Events;

use Kontenta\Kontour\Contracts\AdminVisit;

final class AdminToolVisited
{
    public $visit;

    /**
     * Create a new event instance.
     *
     * @param AdminVisit
     * @return void
     */
    public function __construct(AdminVisit $visit)
    {
        $this->visit = $visit;
    }
}
