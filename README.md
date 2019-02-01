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
- Authorization for `AdminLink`s ensures that the current user has privileges
  before echoing links.

## Architecture

- Kontour is installed as a dependency, not a boilerplate.
- Kontour uses core Laravel functionality wherever possible,
  for example authentication and authorization.

## Install

Maybe you're here because some package you installed requires Kontour for its
admin pages? In that case it's already installed by composer, but you may still
want to read further below about how to configure Kontour to your liking.

Installing Kontour explicitly in your Laravel project:

```bash
composer require kontenta/kontour
```

## Checking the route list

Kontour, and packages using it, will register routes automatically in your
Laravel app. To keep track of what's happening you may print all the routes
using artisan:

```bash
php artisan route:list
```

The list will display information about every URI, route name, and middleware
in your app.
Among others you'll find the `kontour.login`, `kontour.logout`,
and `kontour.index` routes.
If these routes are not to your liking there are configuration values you can
set to change the url prefix or domain.

## Configure Kontour in your Laravel project

Publish the configuration with artisan:

```bash
php artisan vendor:publish --tag="kontour-config"
```

Then you can edit `config/kontour.php` and uncomment any of the
[example settings](https://github.com/kontenta/kontour/blob/master/config/kontour.php)
you want to tweak.

## Logging in

By default the Kontour dashboard route `kontour.index` is reached by going to
`/admin` in your browser.

To enable login you need to make sure the user model you want to give access to
the admin area implements the
[`Kontenta\Kontour\Contracts\AdminUser` contract](https://github.com/kontenta/kontour/blob/master/src/Contracts/AdminUser.php)
which has method `getDisplayName()` that should return... a display name!

The default Kontour configuration uses Laravel's `web` Guard from
`config/auth.php` which in turn uses the Eloquent user provider with model
`App\User::class`.
If you're happy to let **all** your users into the admin area
(i.e. you have no front end users) you can modify that user class to implement
the interface, by having it extend `Kontenta\Kontour\Auth\AdminUser`.

This requirement is deliberate to avoid any situation where someone accidentally
gives front end users access to their admin routes.
You need to make an active choice about which user model to let into the admin
area.

### Creating a separate user provider for admins

The most common situation is that you want a separate table and model for
admin users, and a separate Laravel User Provider and Guard to go with that.

1. Create an Eloquent model and table.
   The simplest way is to make copies of Laravel's `app/User.php` model and
   create users table migration in `database\migrations` and modify them
   to your needs.
2. Make sure the model implements `Kontenta\Kontour\Contracts\AdminUser`,
   perhaps by extending `Kontenta\Kontour\Auth\AdminUser`.
3. Edit `config/auth.php` to add a Guard, User Provider and perhaps a password
   reset configuration:

   ```php
   'guards' => [
     //...
     'admin' => [
       'driver' => 'session',
       'provider' => 'admins',
     ],
   ],

   'providers' => [
     //...
     'admins' => [
       'driver' => 'eloquent',
       'model' => App\AdminUser::class, // Your admin user model
     ],
   ],

   'passwords' => [
     //...
     'admins' => [
       'provider' => 'admins',
       'table' => 'password_resets', //using same table as the main user model
       'expire' => 60,
     ],
   ],
   ```

4. Edit `config/kontour.php` and tell it to use the name of your admin guard,
   and the passwords configuration:

   ```php
   'guard' => 'admin',
   'passwords' => 'admins',
   ```

## Publish the default CSS in your Laravel project

You probably want to add some style to your admin area,
perhaps pure HTML is too brutalist for your taste...
A good place to start is the default Kontour stylesheet.

Publish the CSS file using artisan:

```bash
php artisan vendor:publish --tag="kontour-styling"
```

Then edit `config/kontour.php` and uncomment `'css/kontour.css'` in the
`stylesheets` array to make every admin page pull in the stylesheet.

## Registering admin routes

In a service provider you can register your admin routes
using methods from the
[`RegistersAdminRoutes` trait](https://github.com/kontenta/kontour/blob/master/src/Concerns/RegistersAdminWidgets.php).

## Running code only before admin routes are accessed

For anything that needs to be "booted" before an admin page/route is loaded,
inject `Kontenta\Kontour\Contracts\AdminBootManager` and add callables to it
using `beforeRoute()`.
Those callables will be called (with any dependencies injected) by a middleware.
This avoids running admin-related code on every page load on the public site.

## Extending Kontour's Blade layouts

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

## Form templates

Kontour provides
[some Blade views](https://github.com/kontenta/kontour/tree/master/resources/views/forms)
that can be used with `@include` or `@component` to generate form inputs along
with labels and validation feedback.

```php
<form ...>
@include('kontour::forms.input', ['name' => 'username', 'type' => 'email'])
</form>
```

## Adding menu items

Usually adding menu items is done in a service provider's boot method:

```php
use Kontenta\Kontour\Contracts\AdminBootManager;
use Kontenta\Kontour\Contracts\MenuWidget;
use Kontenta\Kontour\AdminLink;

$this->app->make(AdminBootManager::class)->beforeRoute(function (MenuWidget $menuWidget) {
  $menuWidget->addLink(
    AdminLink::create('A menu item', route('named.route'))
      ->registerAbilityForAuthorization('gate or other ability'),
    'A menu heading'
  );
});
```

## Authorizing controller actions

The
[`AuthorizesAdminRequests` trait](https://github.com/kontenta/kontour/blob/master/src/Concerns/AuthorizesAdminRequests.php)
has convenince methods for controllers that both authorizes the current user
against an ability, and dispatches an event that records the visit for the
recent visits widgets.

With the trait used on your controller you can call
`$this->authorizeShowAdminVisit()` for view-only routes or
`$this->authorizeEditAdminVisit()` for routes that present a form.

Both methods take 4 parameters:

- The name of the ability to authorize against
- The name of the link to present in recent visits widgets
- The description string for link `title` attribute (optional)
- Arguments for the ability (optional)

## Registering widgets

All widgets implement the
[`AdminWidget` interface](https://github.com/kontenta/kontour/blob/master/src/Contracts/AdminWidget.php)
and can be registered into a section from a service provider
or controller using methods from the
[`RegistersAdminWidgets`](`https://github.com/kontenta/kontour/blob/master/src/Concerns/RegistersAdminWidgets.php`)
trait.

In the `kontour.php` config file you may specify the widgets for all
admin pages using the `global_widgets` array, mapping classname/contract to the
desired section name.

## Fallback implementations

This package contains implementations of the Kontour contracts that are used as
a fallback whenever no other implementation has been registered in the Laravel
service container.

Overriding implementations may be registered by service providers of other
packages or your main application.
