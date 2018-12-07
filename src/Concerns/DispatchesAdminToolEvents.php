<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\EditAdminVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\ShowAdminVisit;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;

trait DispatchesAdminToolEvents
{
    use ResolvesAdminUser;

    public function dispatchShowAdminToolVisitedEvent(string $name, string $description = null)
    {
        $visit = new ShowAdminVisit(
            $this->createCurrentAdminLink($name, $description),
            $this->user()
        );
        event(new AdminToolVisited($visit));
    }

    public function dispatchEditAdminToolVisitedEvent(string $name, string $description = null)
    {
        $visit = new EditAdminVisit(
            $this->createCurrentAdminLink($name, $description),
            $this->user()
        );
        event(new AdminToolVisited($visit));
    }

    public function createCurrentAdminLink(string $name, string $description = null)
    {
        return AdminLink::create($name, url()->full(), $description);
    }
}
