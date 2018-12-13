# Kontour

[![Build Status](https://travis-ci.org/kontenta/kontour.svg?branch=master)](https://travis-ci.org/kontenta/kontour)

Kontour is an admin page manager for Laravel.
It provides a shared "frame" for the admin routes you create in your Laravel apps, or in packages you write.

You need at least **Laravel 5.7** and **PHP 7.1** to use this package.

## Benefits in service providers

In a service provider you can register your admin routes using convenient methods from the trait
`Kontenta\Kontour\Concerns\RegistersAdminRoutes`.

For anything that needs to be "booted" before an admin page/route is loaded,
inject `Kontenta\Kontour\Contracts\AdminBootManager` and add callables to it
using `beforeRoute()`.
Those callables will be called (with any dependencies injected) by a middleware.

## Benefits in blade views (or controllers)

In the Blade views you create for your admin pages you can inject a "view manager" instance:

```php
@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
```

...that can be used to pull out the common Blade layout to extend for any admin pages
that wants to be part of the family:

```php
@extends($view_manager->layout())
```

...and also provides names of Blade sections you may extend to populate that layout:

```php
@section($view_manager->mainSection())
<form>
  <input name="title">
  <button>Save</button>
</form>
@append
```

## Fallback implementations

This package contains implementations of the Kontour contracts that are used as a fallback whenever no other
implementation has been registered in the Laravel service container.

Overriding implementations may be registered by service providers of other packages or your main application.
