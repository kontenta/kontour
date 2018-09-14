<?php

namespace Kontenta\Kontour\Events;

use Kontenta\Kontour\Contracts\UrlVisit;
use Illuminate\Queue\SerializesModels;

abstract class AdminToolVisited
{
    use SerializesModels;

    public $visit;

    /**
     * Create a new event instance.
     *
     * @param UrlVisit
     * @return void
     */
    public function __construct(UrlVisit $visit)
    {
        $this->visit = $visit;
    }
}
