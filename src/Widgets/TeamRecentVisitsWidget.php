<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\RecentVisitsRepository;
use Kontenta\Kontour\Contracts\TeamRecentVisitsWidget as TeamRecentVisitsWidgetContract;

class TeamRecentVisitsWidget implements TeamRecentVisitsWidgetContract
{
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
            return !$visit->getUser()->is(Auth::guard(config('kontour.guard'))->user());
        })->unique(function ($visit) {
            return $visit->getLink()->getUrl();
        })->sortByDesc(function ($visit) {
            return $visit->getDateTime();
        });
    }
}
