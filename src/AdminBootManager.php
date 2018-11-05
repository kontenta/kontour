<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminBootManager as BootManagerContract;

class AdminBootManager implements BootManagerContract
{
    /**
     * @var Collection
     */
    private $beforeRouteCallbacks;

    public function __construct()
    {
        $this->beforeRouteCallbacks = new Collection();
    }

    public function beforeRoute(callable $callback): BootManagerContract
    {
        $this->beforeRouteCallbacks->push($callback);

        return $this;
    }

    public function processBeforeRouteCallbacks(): void
    {
        while ($this->beforeRouteCallbacks->count()) {
            app()->call($this->beforeRouteCallbacks->shift());
        }
    }
}
