<?php

namespace Kontenta\KontourSupport;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\Contracts\RecentVisitsRepository as RecentVisitsRepositoryContract;

class RecentVisitsRepository implements RecentVisitsRepositoryContract
{
    private $keyPrefix = 'kontour-recent';

    public function getShowVisits(): Collection
    {
        return Cache::get($this->generateCacheKey('show'), new Collection());
    }

    public function getEditVisits(): Collection
    {
        return Cache::get($this->generateCacheKey('edit'), new Collection());
    }

    public function subscribe($events)
    {
        $events->listen(AdminToolVisited::class, [$this, 'handle']);
    }

    public function handle(AdminToolVisited $event)
    {
        $key = $this->generateCacheKey($event->visit->getType());
        $visits = Cache::get($key, new Collection());
        $visits->push($event->visit);
        Cache::forever($key, $visits);
    }

    protected function generateCacheKey($type) {
        return 'kontour-recent-visits-'.$type;
    }
}
