<?php

namespace Kontenta\KontourSupport\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kontenta\KontourSupport\RecentVisitsRepository;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget as PersonalRecentVisitsWidgetContract;

class PersonalRecentVisitsWidget implements PersonalRecentVisitsWidgetContract
{
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
        return true;
    }

    private function getVisits()
    {
        return $this->repository->getShowVisits()->merge($this->repository->getEditVisits())->filter(function ($visit) {
            return $visit->getUser()->is(Auth::guard(config('kontour.guard'))->user());
        })->unique(function ($visit) {
            return $visit->getLink()->getUrl();
        })->sortByDesc(function ($visit) {
            return $visit->getDateTime();
        });
    }
}
