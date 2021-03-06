<?php

namespace Kontenta\Kontour;

use Illuminate\Routing\Router;
use Kontenta\Kontour\Contracts\AdminAuthenticateMiddleware;
use Kontenta\Kontour\Contracts\AdminBootRouteMiddleware;
use Kontenta\Kontour\Contracts\AdminRouteManager as AdminRouteManagerContract;

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
     * Common admin route attributes for usage with \Illuminate\Routing\Router::group $attribute parameter
     * See https://laravel.com/docs/routing#route-groups
     * @return array
     */
    public function getRouteAttributes(): array
    {
        $attributes = [];
        $attributes['middleware'] = $this->getMiddleware();
        $attributes['prefix'] = $this->getPrefix();
        $attributes['domain'] = $this->getDomain();
        return array_filter($attributes);
    }

    /**
     * Common admin guest route attributes
     * @return array
     */
    public function getGuestRouteAttributes(): array
    {
        $attributes = $this->getRouteAttributes();
        $attributes['middleware'] = collect($attributes['middleware'] ?? [])->filter(function ($value) {
            // Keep everything apart from the auth middleware
            return $value !== AdminAuthenticateMiddleware::class;
        })->toArray();
        return array_filter($attributes);
    }

    /**
     * Common url prefix for admin routes
     * @return string
     */
    public function getPrefix(): string
    {
        return config('kontour.url_prefix');
    }

    /**
     * Common middleware for admin routes
     * @return array
     */
    public function getMiddleware(): array
    {
        return ['web', AdminBootRouteMiddleware::class, AdminAuthenticateMiddleware::class];
    }

    /**
     * Common domain for admin routes
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return config('kontour.domain');
    }

    /**
     * Url for admin index page
     * @return string
     */
    public function indexUrl(): string
    {
        return route('kontour.index');
    }

    /**
     * Url for admin login
     * @return string
     */
    public function loginUrl(): string
    {
        return route('kontour.login');
    }

    /**
     * Url for admin logout
     * @return string
     */
    public function logoutUrl(): string
    {
        return route('kontour.logout');
    }

    /**
     * Url for forgotten password
     * @return string|null
     */
    public function passwordResetUrl()
    {
        $route_name = collect('kontour.password.request', 'password.request')->first(function ($route_name) {
            return $this->router->has($route_name);
        });

        if ($route_name) {
            return route($route_name);
        }
    }
}
