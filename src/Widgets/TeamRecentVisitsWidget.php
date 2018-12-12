<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\RecentVisitsRepository;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget as TeamRecentVisitsWidgetContract;

class TeamRecentVisitsWidget implements TeamRecentVisitsWidgetContract
{
    use ResolvesAdminUser;

    protected $repository;

    public function __construct(RecentVisitsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function toHtml()
    {
        return View::make('kontour::widgets.teamRecentVisits', ['visits' => $this->getVisits()])->render();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return (bool) $user;
    }

    private function getVisits()
    {
        return $this->repository->getEditVisits()->filter(function ($visit) {
            return !$visit->getUser()->is($this->adminUser()) and $visit->getLink()->isAuthorized($this->adminUser());
        })->unique(function ($visit) {
            return $visit->getLink()->getUrl();
        })->sortByDesc(function ($visit) {
            return $visit->getDateTime();
        });
    }
}
