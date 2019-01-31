# Kontour

[![Build Status](https://travis-ci.org/kontenta/kontour.svg?branch=master)](https://travis-ci.org/kontenta/kontour)

Kontour is a package of admin page utilities for Laravel.
It provides a shared "frame" for the admin routes you create
in your Laravel apps, or in packages you write.

The idea is that your admin tools can pull in and use functionality from Kontour
to provide a consistent experience for the whole admin area of a website.
Your admin tools are built using standard Laravel routes, controllers,
authentication, authorization, validation, views, etc.
Kontour is there to provide enhancements and reusable elements for your admin
area.

You need at least **Laravel 5.7** and **PHP 7.1** to use this package.

## Features

- Admin login and password reset routes with configurable Guard
  to separate admin users from frontend users.
- Extendable Blade Layouts with named sections for admin tool views
  and configurable stylesheet and javascript dependencies.
- Widgets that are placeable in named Blade sections:
  - Global widgets for menu, logout, and recently used tools.
  - Tool widgets for feedback messages, crumbtrail, and item history.
- Admin route groups with configurable url-prefix and domain.
- Reusable form input Blade includes/components.
- Authorization for `AdminLink`s ensures current user has privileges before
  printing links.

## Architecture

- Kontour is installed as a dependency, not a boilerplate.
- Kontour uses core Laravel functionality wherever possible,
  for example authentication and authorization.

## Benefits in service providers

### Register admin routes

In a service provider you can register your admin routes using convenient
methods from the trait `Kontenta\Kontour\Concerns\RegistersAdminRoutes`.

### Running code only before admin routes are accessed

For anything that needs to be "booted" before an admin page/route is loaded,
inject `Kontenta\Kontour\Contracts\AdminBootManager` and add callables to it
using `beforeRoute()`.
Those callables will be called (with any dependencies injected) by a middleware.
This avoids running admin-related code on every page load on the public site.

## Benefits in blade views (or controllers)

### Extending Kontour's Blade layouts

In the Blade views you create for your admin pages you can inject
a "view manager" instance:

```php
@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
```

...that can be used to pull out one of the common Blade layouts to extend for
any admin pages that wants to be part of the family:

```php
@extends($view_manager->toolLayout())
```

The `toolLayout` has sections `kontourToolHeader`, `kontourToolMain`,
`kontourToolWidgets`, and `kontourToolFooter` for you to populate.

```php
@section('kontourToolHeader')
  <h1>A splendid tool</h1>
  @parent
@endsection

@section('kontourToolMain')
  <form ...>
    <input ...>
    <button type="submit">Save</button>
  </form>
@endsection
```

It's a good idea to include `@parent` in your sections for other content,
for example registered widgets.

## Registering widgets

All widgets implement the
[`AdminWidget` interface](https://github.com/kontenta/kontour/blob/master/src/Contracts/AdminWidget.php)
and can be registered into a section from a service provider
or controller using methods from the
[`RegistersAdminWidgets`](`https://github.com/kontenta/kontour/blob/master/src/Concerns/RegistersAdminWidgets.php`)
trait.

## Fallback implementations

This package contains implementations of the Kontour contracts that are used as
a fallback whenever no other implementation has been registered in the Laravel
service container.

Overriding implementations may be registered by service providers of other
packages or your main application.
