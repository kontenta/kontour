# Time templates

There's a [view](../resources/views/elements/time.blade.php)
for rendering [`<time>` tags](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/time)
to which you supply a [`Carbon`](https://carbon.nesbot.com)
`$carbon` variable and it prints a proper `datetime` atom string attribute
and by default a human readable time difference.

```php
@include('kontour::elements.time', ['carbon' => \Carbon\Carbon::now()])
```

You may also pass a `$format` string to display the tag contents in a specific format
instad of the default relative time.
If you pass `['format' => true]` the default format from Kontour's [config file](../config/kontour.php) will be used.
