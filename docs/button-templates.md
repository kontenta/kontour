# Button templates

[The button views](../resources/views/buttons/)
generate button elements for common actions like "create", "update", and
"destroy", as well as a "generic" button, and a "link"-like button.
The button views take a `$buttonAttributes` array of HTML attributes to set on
the button element.

```php
@component('kontour::buttons.generic', ['type' => 'reset'])
  Oh, the old <code>reset</code> button!
@endcomponent
```

There's also a logout button and hamburger menu button.
