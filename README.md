# Kontour

Kontour is an admin page manager for Laravel.
It provides a "frame" around the admin routes you create in your Laravel apps,or in packages you write.

## Benefits in service providers

In a service provider you can register your admin routes using convenient methods from the trait
`Kontenta\Kontour\Concerns\RegistersAdminRoutes`.

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
