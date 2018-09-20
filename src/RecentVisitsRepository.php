<?php

namespace Kontenta\KontourSupport;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kontenta\Kontour\Events\AdminToolShowVisited;
use Kontenta\Kontour\Events\AdminToolEditVisited;
use Kontenta\Kontour\Contracts\RecentVisitsRepository as RecentVisitsRepositoryContract;

class RecentVisitsRepository implements RecentVisitsRepositoryContract
{
    /**
     * Return all "show" UrlVisits in storage
     */
    public function getShowVisits(): Collection
    {
        return Cache::get('recentShowVisits', new Collection());
    }

    /**
     * Return all "edit" UrlVisits in storage
     */
    public function getEditVisits(): Collection
    {
        return Cache::get('recentEditVisits', new Collection());
    }
    
    public function subscribe($events)
    {
        $events->listen(AdminToolShowVisited::class, [$this, 'handleShow']);
        $events->listen(AdminToolEditVisited::class, [$this, 'handleEdit']);
    }

    public function handleShow(AdminToolShowVisited $event)
    {
        $visits = Cache::get('recentShowVisits', new Collection());
        $visits->push($event->visit);
        Cache::forever('recentShowVisits', $visits);
    }

    public function handleEdit(AdminToolEditVisited $event)
    {
        $visits = Cache::get('recentEditVisits', new Collection());
        $visits->push($event->visit);
        Cache::forever('recentEditVisits', $visits);
    }

    
}
