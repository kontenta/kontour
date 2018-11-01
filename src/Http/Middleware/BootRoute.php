<?php

namespace Kontenta\Kontour\Http\Middleware;

use Closure;
use Kontenta\Kontour\Contracts\AdminBootManager;
use Kontenta\Kontour\Contracts\AdminBootRouteMiddleware;

class BootRoute implements AdminBootRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO: should the AdminBootManager be injected into constructor instead of resolved here?
        app(AdminBootManager::class)->processBeforeRouteCallbacks();

        return $next($request);
    }
}
