# Kontour

[![Build Status](https://travis-ci.org/kontenta/kontour.svg?branch=master)](https://travis-ci.org/kontenta/kontour)

Kontour is an admin page manager for Laravel.
It provides a shared "frame" for the admin routes you create in your Laravel apps, or in packages you write.

You need at least **Laravel 5.7** and **PHP 7.1** to use this package.

## What makes Kontour different from other admin panels

- Installed as a dependency, not a boilerplate.
- Tools/controllers can be written to work without Kontour, but if Kontour is available they are enhanced.
- Uses core Laravel functionality wherever possible.
- Classes are built on contracts resolved from the Laravel service container so you may override with your own implementations.

## Benefits in service providers

### Register admin routes

In a service provider you can register your admin routes using convenient methods from the trait
`Kontenta\Kontour\Concerns\RegistersAdminRoutes`.

### Running code only before admin routes are accessed

For anything that needs to be "booted" before an admin page/route is loaded,
inject `Kontenta\Kontour\Contracts\AdminBootManager` and add callables to it
using `beforeRoute()`.
Those callables will be called (with any dependencies injected) by a middleware.
This avoids running admin-related code on every page load on the public site.

## Benefits in blade views (or controllers)

### Extending Kontour's Blade layouts

In the Blade views you create for your admin pages you can inject a "view manager" instance:

```php
@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
```

...that can be used to pull out the common Blade layout to extend for any admin pages
that wants to be part of the family:

```php
@extends($view_manager->layout())
```

## Fallback implementations

This package contains implementations of the Kontour contracts that are used as a fallback whenever no other
implementation has been registered in the Laravel service container.

Overriding implementations may be registered by service providers of other packages or your main application.
