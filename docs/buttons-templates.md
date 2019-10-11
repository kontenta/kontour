# Button templates

[The button views](https://github.com/kontenta/kontour/tree/master/resources/views/buttons)
generate buttom elements for common actions like "create", "update", and "destroy",
as well as a "generic" button, and a "link"-like button.
The button views take a `$buttonAttributes` array of html attributes to set on the button element.

```php
@component('kontour::buttons.generic', ['type' => 'reset'])
  Oh, the old <code>reset</code> button!
@endcomponent
```

There's also a logout button and hamburger menu button.
