<?php

namespace Kontenta\Kontour\Events;

use Kontenta\Kontour\Contracts\AdminVisit;
use Illuminate\Queue\SerializesModels;

final class AdminToolVisited
{
    use SerializesModels;

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
