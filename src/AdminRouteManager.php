<?php

namespace Erik\AdminManagerImplementation;

use Erik\AdminManager\Contracts\AdminAuthenticateMiddleware;
use Erik\AdminManager\Contracts\AdminRouteManager as AdminRouteManagerContract;

class AdminRouteManager implements AdminRouteManagerContract
{
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
        return config('admin.url_prefix');
    }

    /**
     * Common middleware for admin routes
     * @return array
     */
    public function getMiddleware(): array
    {
        return ['web', AdminAuthenticateMiddleware::class];
    }

    /**
     * Common domain for admin routes
     * @return string|null
     */
    public function getDomain()
    {
        return config('admin.domain');
    }

    /**
     * Url for admin index page
     * @return string
     */
    public function indexUrl(): string
    {
        return route('admin.index');
    }

    /**
     * Url for admin login
     * @return string
     */
    public function loginUrl(): string
    {
        return route('admin.login');
    }

    /**
     * Url for admin logout
     * @return string
     */
    public function logoutUrl(): string
    {
        return route('admin.logout');
    }
}
