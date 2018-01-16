<?php

namespace Erik\AdminManagerImplementation;

use App\Http\Middleware\AuthenticateAdmin;
use Erik\AdminManager\Contracts\AdminRouteManager as AdminRouteManagerContract;
use Illuminate\Routing\Router;

class AdminRouteManager implements AdminRouteManagerContract
{
    /**
     * @var Router
     */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register given routes to admin tools with the Laravel router.
     * Will set any common admin route attributes such as prefix, middleware, and domain.
     *
     * @param \Closure|string $routes See \Illuminate\Routing\Router::loadRoutes
     * @return $this
     */
    public function registerRoutes($routes)
    {
        $this->router->group($this->getRouteAttributes(), $routes);
        return $this;
    }

    /**
     * Common admin route attributes for usage with \Illuminate\Routing\Router::group $attribute parameter
     * See https://laravel.com/docs/routing#route-groups
     * @return array
     */
    public function getRouteAttributes(): array
    {
        $attributes = [];
        $attributes['middleware'] = $this->getMiddleware();
        return array_filter($attributes);
    }

    /**
     * Common url prefix for admin routes
     * @return string
     */
    public function getPrefix(): string
    {
        // TODO: Implement getPrefix() method.
        return '';
    }

    /**
     * Common middleware for admin routes
     * @return array
     */
    public function getMiddleware(): array
    {
        return [AuthenticateAdmin::class];
    }

    /**
     * Common domain for admin routes
     * @return string|null
     */
    public function getDomain()
    {
        // TODO: Implement getDomain() method.
        return null;
    }

    /**
     * Url for admin index page
     * @return string
     */
    public function indexUrl(): string
    {
        // TODO: Implement indexUrl() method.
        return '';
    }

    /**
     * Url for admin login
     * @return string
     */
    public function loginUrl(): string
    {
        // TODO: Implement loginUrl() method.
        return '';
    }

    /**
     * Url for admin logout
     * @return string
     */
    public function logoutUrl(): string
    {
        // TODO: Implement logoutUrl() method.
        return '';
    }
}
