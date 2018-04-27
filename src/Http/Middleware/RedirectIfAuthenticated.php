<?php

namespace Erik\AdminManagerImplementation\Http\Middleware;

use Closure;
use Erik\AdminManager\Contracts\AdminGuestMiddleware;
use Illuminate\Support\Facades\Auth;
use Erik\AdminManager\Contracts\AdminRouteManager;

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
        if (Auth::guard(config('admin.guard'))->check()) {
            return redirect(app(AdminRouteManager::class)->indexUrl());
        }

        return $next($request);
    }
}
