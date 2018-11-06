<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\EditAdminVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\ShowAdminVisit;

trait DispatchesAdminToolEvents
{
    public function dispatchShowAdminToolVisitedEvent(string $name, string $description = null)
    {
        $visit = new ShowAdminVisit(
            $this->createCurrentAdminLink($name, $description),
            $this->getCurrentAdminUser()
        );
        event(new AdminToolVisited($visit));
    }

    public function dispatchEditAdminToolVisitedEvent(string $name, string $description = null)
    {
        $visit = new EditAdminVisit(
            $this->createCurrentAdminLink($name, $description),
            $this->getCurrentAdminUser()
        );
        event(new AdminToolVisited($visit));
    }

    public function createCurrentAdminLink(string $name, string $description = null)
    {
        return AdminLink::create($name, url()->full(), $description);
    }

    public function getCurrentAdminUser()
    {
        return auth()->guard(config('kontour.guard'))->user();
    }
}
