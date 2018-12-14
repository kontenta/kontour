<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kontenta\Kontour\Contracts\RecentVisitsRepository as RecentVisitsRepositoryContract;
use Kontenta\Kontour\Events\AdminToolVisited;

class RecentVisitsRepository implements RecentVisitsRepositoryContract
{
    private $keyPrefix = 'kontour-recent';

    public function getShowVisits(): Collection
    {
        return $this->getVisits('show');
    }

    public function getEditVisits(): Collection
    {
        return $this->getVisits('edit');
    }

    protected function getVisits(string $type)
    {
        return Cache::get($this->generateCacheKey($type), new Collection());
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

    protected function generateCacheKey($type)
    {
        return 'kontour-recent-visits-' . $type;
    }
}
