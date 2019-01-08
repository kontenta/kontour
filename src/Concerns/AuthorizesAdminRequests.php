<?php

namespace Kontenta\Kontour\Concerns;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\Contracts\AdminVisit;
use Kontenta\Kontour\EditAdminVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\ShowAdminVisit;

trait AuthorizesAdminRequests
{
    use AuthorizesRequests;
    use ResolvesAdminUser;

    /**
     * Authorize the current request with the admin user, and dispatch a ShowAdminVisit event.
     */
    public function authorizeShowAdminVisit(
        $ability,
        string $linkName,
        $abilityArguments = [],
        string $linkDescription = null
    ): AdminVisit {
        $link = $this->authorizeAdminVisit($ability, $linkName, $abilityArguments, $linkDescription);
        $visit = new ShowAdminVisit($link, $this->adminUser());
        event(new AdminToolVisited($visit));

        return $visit;
    }

    /**
     * Authorize the current request with the admin user, and dispatch a EditAdminVisit event.
     */
    public function authorizeEditAdminVisit(
        $ability,
        string $linkName,
        $abilityArguments = [],
        string $linkDescription = null
    ): AdminVisit {
        $link = $this->authorizeAdminVisit($ability, $linkName, $abilityArguments, $linkDescription);
        $visit = new EditAdminVisit($link, $this->adminUser());
        event(new AdminToolVisited($visit));

        return $visit;
    }

    protected function authorizeAdminVisit(
        $ability,
        string $linkName,
        $abilityArguments = [],
        string $linkDescription = null
    ): AdminLink {
        [$ability, $abilityArguments] = $this->parseAbilityAndArguments($ability, $abilityArguments);

        $result = $this->authorizeForUser($this->adminUser(), $ability, $abilityArguments);

        return AdminLink::create($linkName, url()->full(), $linkDescription)
            ->registerAbilityForAuthorization($ability, $abilityArguments);
    }
}
