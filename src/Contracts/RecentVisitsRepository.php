<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Support\Collection;

interface RecentVisitsRepository
{
    /**
     * Return all ShowAdminVisits in storage
     */
    public function getShowVisits(): Collection;

    /**
     * Return all EditAdminVisits in storage
     */
    public function getEditVisits(): Collection;
}
