<?php

namespace Kontenta\Kontour\Contracts;

interface AdminBootManager
{
    /**
     * Add a callback to be run before any admin route is invoked
     * @param callable $callback
     * @return $this
     */
    public function beforeRoute(callable $callback): AdminBootManager;

    /**
     * Invoke any registerered before-route callbacks that have not yet been processed
     * @return void
     */
    public function processBeforeRouteCallbacks(): void;
}
