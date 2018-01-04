<?php

namespace Erik\AdminManager\Contracts;

//TODO: rename RouteManager to AdminRouteManager
interface RouteManager
{
    /**
     * Register given routes to admin tools with the Laravel router.
     * Will set any common admin route attributes such as prefix, middleware, and domain.
     *
     * @param \Closure|string $routes See \Illuminate\Routing\Router::loadRoutes
     */
    public function registerRoutes($routes);

    /**
     * Common admin route attributes for usage with \Illuminate\Routing\Router::group $attribute parameter
     * See https://laravel.com/docs/routing#route-groups
     * @return array
     */
    public function getRouteAttributes(): array;

    /**
     * Common url prefix for admin routes
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Common middleware for admin routes
     * @return array
     */
    public function getMiddleware(): array;

    /**
     * Common domain for admin routes
     * @return string|null
     */
    public function getDomain();

    /**
     * Url for admin index page
     * @return string
     */
    public function indexUrl(): string;

    /**
     * Url for admin login
     * @return string
     */
    public function loginUrl(): string;

    /**
     * Url for admin logout
     * @return string
     */
    public function logoutUrl(): string;
}
