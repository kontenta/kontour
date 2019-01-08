<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kontenta\Kontour\Contracts\RecentVisitsRepository as RecentVisitsRepositoryContract;
use Kontenta\Kontour\Events\AdminToolVisited;

class RecentVisitsRepository implements RecentVisitsRepositoryContract
{
    protected $keyPrefix = 'kontour-recent-visits';
    protected $userListKey = 'kontour-recent-users';

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
        return collect($this->getRecentUsers())->flatMap(function ($userId) use ($type) {
            try {
                return Cache::get($this->generateCacheKey($type, $userId), new Collection());
            } catch (\Exception $e) {
                return new Collection();
            }
        })->sortByDesc->getDateTime();
    }

    public function subscribe($events)
    {
        $events->listen(AdminToolVisited::class, [$this, 'handle']);
    }

    public function handle(AdminToolVisited $event)
    {
        $userId = $event->visit->getUser()->getAuthIdentifier();
        $this->addRecentUser($userId);
        $key = $this->generateCacheKey($event->visit->getType(), $userId);
        $visits = Cache::get($key, new Collection());
        $visits->prepend($event->visit);
        $visits = $visits->take(10);
        Cache::forever($key, $visits);
    }

    protected function getRecentUsers(): array
    {
        return Cache::get($this->userListKey, []);
    }

    protected function addRecentUser(string $userId): void
    {
        $users = $this->getRecentUsers();
        if (!in_array($userId, $users)) {
            $users[] = $userId;
            Cache::forever($this->userListKey, $users);
        }
    }

    protected function generateCacheKey(string $type, string $userId)
    {
        return implode('-', [$this->keyPrefix, $type, $userId]);
    }
}
