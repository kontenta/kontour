<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Concerns\ResolvesAdminUser;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget as PersonalRecentVisitsWidgetContract;
use Kontenta\Kontour\RecentVisitsRepository;

class PersonalRecentVisitsWidget implements PersonalRecentVisitsWidgetContract
{
    use ResolvesAdminUser;

    protected $repository;

    public function __construct(RecentVisitsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function toHtml()
    {
        return View::make('kontour::widgets.personalRecentVisits', ['visits' => $this->getVisits()])->render();
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return (bool) $user;
    }

    private function getVisits()
    {
        return $this->repository->getShowVisits()->merge($this->repository->getEditVisits())
            ->filter(function ($visit) {
                return $visit->getUser()->is($this->adminUser()) and $visit->getLink()->isAuthorized($this->adminUser());
            })
            ->sortByDesc->getDateTime()
            ->take(10);
    }
}
