<?php

namespace Kontenta\Kontour\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Kontenta\Kontour\Contracts\AdminAuthenticateMiddleware;
use Kontenta\Kontour\Contracts\AdminRouteManager;

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
        $guards[] = config('kontour.guard');
        $this->authenticate($request, $guards);

        if (!$this->auth->user() instanceof \Kontenta\Kontour\Contracts\AdminUser) {
            throw new \UnexpectedValueException('Admin user class needs to implement \Kontenta\Kontour\Contracts\AdminUser');
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return app(AdminRouteManager::class)->loginUrl();
    }
}
