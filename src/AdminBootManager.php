<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Collection;
use Kontenta\Kontour\Contracts\AdminBootManager as BootManagerContract;

class AdminBootManager implements BootManagerContract
{
    /**
     * @var Collection
     */
    private $beforeRouteCallables;

    public function __construct()
    {
        $this->beforeRouteCallables = new Collection();
    }

    public function beforeRoute(callable $callback): BootManagerContract
    {
        $this->beforeRouteCallables->push($callback);

        return $this;
    }

    public function processBeforeRouteCallbacks(): void
    {
        // TODO: pop and call each callback
    }
}
