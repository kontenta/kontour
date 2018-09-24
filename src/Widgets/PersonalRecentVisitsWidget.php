<?php

namespace Kontenta\KontourSupport\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget as PersonalRecentVisitsWidgetContract;
use Kontenta\KontourSupport\RecentVisitsRepository;

class PersonalRecentVisitsWidget implements PersonalRecentVisitsWidgetContract
{
    protected $repository;

    public function __construct(RecentVisitsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function toHtml()
    {
        return '<aside data-kontour-widget="PersonalRecentVisitsWidget"><header>Recent</header><ul>' . $this->getVisits()->map(function ($visit) {
            return '<li data-kontour-visit-type="' . $visit->getType() . '">' . $visit->getLink()->toHtml() . '</li>';
        })->implode("\n") . '</ul></aside>';
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
