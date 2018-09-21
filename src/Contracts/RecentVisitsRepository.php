<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Support\Collection;

interface RecentVisitsRepository
{
    /**
     * Return all "show" UrlVisits in storage
     */
    public function getShowVisits(): Collection;

    /**
     * Return all "edit" UrlVisits in storage
     */
    public function getEditVisits(): Collection;
}
