# Using Kontour to build admin tools

Admin tools that leverage Kontour are built as any other Laravel controller with
corresponding routes. Usually a
[resource controller](https://laravel.com/docs/controllers#resource-controllers)
is suitable to create admin tools that edit instances of a specific model.

## Registering admin routes

In a service provider you can register your admin routes
using methods from the
[`RegistersAdminRoutes` trait](../src/Concerns/RegistersAdminRoutes.php)
that will group the routes with all route attributes configured with Kontour,
like middleware etc.

In a Laravel app you can for example create a routes file `routes/kontour.php`
to keep routes for all Kontour tools you create. A service provider using the
trait may then register them in the boot method.

```php
use Kontenta\Kontour\Concerns\RegistersAdminRoutes;

public function boot()
{
  $this->registerAdminRoutes(base_path('routes/kontour.php'));
}
```

If you're writing a package, the routes file would probably be named something
more package specific, and the service provider would need to use a relative
path, like
`__DIR__ . '/../routes/kontour.php'` to register the routes.

## Running code only before admin routes are accessed

For anything that needs to be "booted" before an admin page/route is loaded,
inject `Kontenta\Kontour\Contracts\AdminBootManager` and add callables to it
using `beforeRoute()`.
Those callables will be called (with any dependencies injected) by a middleware.
This avoids running admin-related code on every page load on the public site.

## Extending Kontour Blade layouts

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
[`AuthorizesAdminRequests` trait](../src/Concerns/AuthorizesAdminRequests.php)
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
[`AdminWidget` interface](../src/Contracts/AdminWidget.php)
and can be registered into a section from a service provider
or controller using methods from the
[`RegistersAdminWidgets`](../src/Concerns/RegistersAdminWidgets.php)
trait.

In the `kontour.php` config file you may specify the widgets for all
admin pages using the `global_widgets` array, mapping classname/contract to the
desired section name.
