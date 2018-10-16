<?php

namespace Kontenta\Kontour\Concerns;

/**
 * Trait RegistersAdminRoutes
 * @property \Illuminate\Foundation\Application $app
 */
trait RegistersAdminRoutes
{
    /**
     * Register admin routes
     * @param \Closure|string $routes
     * @see \Illuminate\Routing\Router::loadRoutes
     */
    public function registerAdminRoutes($routes)
    {
        if (!app()->routesAreCached()) {
            app('router')->group($this->resolveAdminRouteManager()->getRouteAttributes(), $routes);
        }
    }

    /**
     * Register admin guest routes
     * @param \Closure|string $routes
     * @see \Illuminate\Routing\Router::loadRoutes
     */
    public function registerAdminGuestRoutes($routes)
    {
        if (!app()->routesAreCached()) {
            app('router')->group($this->resolveAdminRouteManager()->getGuestRouteAttributes(), $routes);
        }
    }

    protected function resolveAdminRouteManager(): \Kontenta\Kontour\Contracts\AdminRouteManager
    {
        return app(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
    }
}
