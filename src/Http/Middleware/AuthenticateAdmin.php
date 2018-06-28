<?php

namespace Kontenta\KontourImplementation\Http\Middleware;

use Closure;
use Kontenta\Kontour\Contracts\AdminAuthenticateMiddleware;
use Kontenta\Kontour\Contracts\AdminRouteManager;
use Illuminate\Auth\AuthenticationException;

class AuthenticateAdmin extends \Illuminate\Auth\Middleware\Authenticate implements AdminAuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards[] = config('admin.guard');
        try {
            return parent::handle($request, $next, ...$guards);
        } catch (AuthenticationException $e) {
            if (!$request->expectsJson()) {
                return redirect()->guest(app(AdminRouteManager::class)->loginUrl());
            }
            throw $e;
        }
    }
}
