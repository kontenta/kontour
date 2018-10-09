<?php

namespace Kontenta\KontourSupport\Http\Middleware;

use Closure;
use Kontenta\Kontour\Contracts\AdminGuestMiddleware;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Contracts\AdminRouteManager;

class RedirectIfAuthenticated implements AdminGuestMiddleware
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
        if (Auth::guard(config('kontour.guard'))->check()) {
            return redirect(app(AdminRouteManager::class)->indexUrl());
        }

        return $next($request);
    }
}
