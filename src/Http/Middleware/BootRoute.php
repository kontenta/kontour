<?php

namespace Kontenta\Kontour\Http\Middleware;

use Closure;
use Kontenta\Kontour\Contracts\AdminBootManager;
use Kontenta\Kontour\Contracts\AdminBootRouteMiddleware;

class BootRoute implements AdminBootRouteMiddleware
{
    /**
     * @var AdminBootManager
     */
    private $bootManager;

    public function __construct(AdminBootManager $bootManager)
    {
        $this->bootManager = $bootManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->bootManager->processBeforeRouteCallbacks();

        return $next($request);
    }
}
