<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminBootManager as BootManagerContract;
use Illuminate\Support\Facades\App;

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
            App::call($this->beforeRouteCallbacks->shift());
        }
    }
}
