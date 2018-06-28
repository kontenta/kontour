<?php

namespace Kontenta\AdminManager\Concerns;

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
        if (!$this->app->routesAreCached()) {
            $this->app['router']->group($this->resolveAdminRouteManager()->getRouteAttributes(), $routes);
        }
    }

    /**
     * Register admin guest routes
     * @param \Closure|string $routes
     * @see \Illuminate\Routing\Router::loadRoutes
     */
    public function registerAdminGuestRoutes($routes)
    {
        if (!$this->app->routesAreCached()) {
            $this->app['router']->group($this->resolveAdminRouteManager()->getGuestRouteAttributes(), $routes);
        }
    }

    protected function resolveAdminRouteManager(): \Kontenta\AdminManager\Contracts\AdminRouteManager
    {
        return $this->app->make(\Kontenta\AdminManager\Contracts\AdminRouteManager::class);
    }
}
