<?php

namespace Kontenta\KontourSupport\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\ItemHistoryWidget as ItemHistoryWidgetContract;
use Kontenta\Kontour\Contracts\AdminUser;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class ItemHistoryWidget implements ItemHistoryWidgetContract
{
    /**
     * @var Collection
     */
    protected $entries;

    public function __construct()
    {
        $this->entries = new Collection();
    }

    public function toHtml()
    {
        return View::make('kontour::widgets.itemHistory', ['entries' => $this->entries])->render();
    }

    public function addEntry(string $action, \DateTime $datetime, AdminUser $user = null): ItemHistoryWidgetContract
    {
        $datetime = Carbon::instance($datetime);
        $this->entries->push(compact('action', 'datetime', 'user'));
        return $this;
    }
    
    public function addCreatedEntry(\DateTime $datetime, AdminUser $user = null): ItemHistoryWidgetContract
    {
        return $this->addEntry('created', $datetime, $user);
    }

    public function addUpdatedEntry(\DateTime $datetime, AdminUser $user = null): ItemHistoryWidgetContract
    {
        return $this->addEntry('updated', $datetime, $user);
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
