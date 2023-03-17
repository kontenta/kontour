# Kontour

[![Build Status](https://travis-ci.org/kontenta/kontour.svg?branch=master)](https://travis-ci.org/kontenta/kontour)

Kontour is a package of admin page utilities for
[Laravel](https://laravel.com/docs).
It provides a shared "frame" for the admin tool routes you create
in your Laravel apps, or in packages you install or create.

The idea is that your admin tools can pull in and use functionality from Kontour
to provide a consistent experience for the whole admin area of a website.
Your admin tools are built using standard Laravel routes, controllers,
authentication, authorization, validation, views, etc.
Kontour is there to provide enhancements and reusable elements for your admin
area.

You need at least **Laravel 8** to use the latest version of this package.

## Using Kontour in a Laravel app

This document aims to provide instructions on how to configure Kontour in a
Laravel app. Once configured you can log in to the Kontour admin area and use
any admin tools from installed packages.

## Creating admin tools using Kontour

For documentation how to create and register your own tools leveraging the
features Kontour provides, you'll find the documentation and helpful guides in
[Using Kontour to build admin tools](docs/tool-creation.md).

## Features

- Admin login and password reset routes with configurable Guard
  to separate admin users from frontend users. Bring your own `AdminUser` model!
- Extendable Blade Layouts with named sections for admin tool views
  and configurable stylesheet and javascript dependencies.
- Widgets that are placeable in named Blade sections:
  - Global widgets for menu, logout, and recently used tools.
  - Tool widgets for feedback messages, crumbtrail, and item history.
- Admin route groups with configurable url-prefix and domain.
- Reusable Blade includes/components:
  - [Form tempates](docs/form-templates.md).
  - [Button templates](docs/button-templates.md).
  - [Time templates](docs/time-templates.md).
- Authorization for `AdminLink`s ensures that the current user has privileges
  before echoing links.

## Architecture

- Kontour is installed as a dependency in a Laravel project, not a boilerplate.
- Kontour uses core Laravel functionality wherever possible,
  like authentication and authorization, and has no dependencies outside of the
  Laravel ecosystem.
- Everything Kontour provides is optional and can be configured to leave a
  minimal footprint in the Laravel app in which it has been installed.

## Install

Maybe you're here because some package you installed requires Kontour for its
admin pages? In that case Kontour is already installed by composer, but you will
still want to read further below about how to configure Kontour to your liking.

You are the owner of your Laravel app, even if Kontour was required by some
other package, and you'll at least need to setup the admin user model before
you can log in to the Kontour admin area.

Installing Kontour explicitly in your Laravel project:

```bash
composer require kontenta/kontour
```

If you don't want the Kontour service provider to run in your project you may
[opt out of package discovery](https://laravel.com/docs/packages#package-discovery).

## Checking the route list

Kontour, and packages using it, will register routes automatically in your
Laravel app. To keep track of what's happening you may print all the routes
using `artisan`:

```bash
php artisan route:list -c
```

The list will display information about every URI, route name, and middleware
in your app.
Among others you'll find the `kontour.login`, `kontour.logout`,
and `kontour.index` routes.
If these routes are not to your liking there are configuration values you can
set to change the url prefix or domain, or even turn them off completely.

## Configure Kontour in your Laravel project

Publish the configuration with `artisan`:

```bash
php artisan vendor:publish --tag="kontour-config"
```

Then you can edit `config/kontour.php` and uncomment any of the
[example settings](config/kontour.php)
you want to tweak.

## Logging in

By default the Kontour dashboard route `kontour.index` is reached by going to
`/admin` in your browser.

To enable login you need to make sure the user model you want to give access to
the admin area implements the
[`Kontenta\Kontour\Contracts\AdminUser` contract](src/Contracts/AdminUser.php)
which has a method `getDisplayName()` that should return... a display name!

The default Kontour configuration uses Laravel's `web` Guard from
`config/auth.php` which in turn uses the Eloquent user provider with model
`App\User::class`.
If you're happy to let **all** your users into the admin area
(i.e. you have no front end users) you can modify that user class to implement
the interface, by having it extend `Kontenta\Kontour\Auth\AdminUser`.

This requirement is deliberate to avoid any situation where someone accidentally
gives front end users access to their admin routes.
**You need to make an active choice about which user model to let into the admin
area.**

### Creating a separate user provider for admins

The most common situation is that you want a separate table and model for
admin users, and a separate Laravel User Provider and Guard to go with that.

1. Create an Eloquent model and table.
   The simplest way is to make copies of Laravel's original `app/User.php` model
   and
   `database/migrations/2014_10_12_000000_create_users_table.php` migration
   and modify them to your needs.
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

### Creating admin users

It doesn't make sense to have a public registration for admin users so
the easiest way to create admin users for development and production is through
`php artisan tinker`:

```php
/* Use the name of your admin model, this examples uses the default App\User */

// List all users
App\User::all();

// Start building a new user object
$user = new App\User();

// Set fields
$user->name = 'Admin';
$user->email = 'admin@yourdomain.net';

// Set a password (remember to send it to the user):
$user->password = bcrypt(...);
// ...or have the user reset password before logging in (if you've added a password reset configuration):
$user->password = '';

// Then save the user!
$user->save();
```

If you're feeling adventurous, you can then create an admin tool within Kontour
to let a logged in admin create and invite new admin users!

## Publish the default CSS and js in your Laravel project

You probably want to add some style to your admin area,
pure HTML with default browser styles is too brutalist for most people...
A good place to start is the default Kontour stylesheet.

The included javascript includes a feature to confirm any delete-action before
submitting those forms, and a confirmation before leaving a page with "dirty"
form inputs.

### Method A: `artisan`

Traditionally, publishing assets is done using `artisan`.

#### Publish CSS with `artisan`

```bash
php artisan vendor:publish --tag="kontour-styling"
```

Then edit `config/kontour.php` and uncomment `'css/kontour.css'` in the
`stylesheets` array to make every admin page pull in the stylesheet.

#### Publish js with `artisan`

```bash
php artisan vendor:publish --tag="kontour-js"
```

Then edit `config/kontour.php` and uncomment `'js/kontour.js'` in the
`javascripts` array to make every admin page pull in the javascript.

### Method B: Mix

It's also possible to use [Laravel Mix](https://laravel.com/docs/mix)
to copy and *version* public assets.

In `webpack.mix.js`:

```js
mix
  .copy("vendor/kontenta/kontour/resources/css/kontour.css", "public/css")
  .copy("vendor/kontenta/kontour/resources/js/kontour.js", "public/js");

if (mix.inProduction()) {
  mix.version();
}
```

In `config/kontour.php`

```php
'stylesheets' => [
        (string) mix('css/kontour.css'),
    ],
    'javascripts' => [
        (string) mix('js/kontour.js'),
    ],
```

Casting Mix's output to a string in the config file makes it possible to cache
the config in a production environment.

## Fallback implementations

This package contains implementations of the Kontour contracts that are used as
a fallback whenever no other implementation has been registered in the Laravel
service container.

Overriding implementations may be registered by service providers of other
packages or your main application.
