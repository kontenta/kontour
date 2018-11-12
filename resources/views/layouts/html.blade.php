<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', config('kontour.title'))</title>

  @stack('meta')

  @stack('styles')

  @stack('head')

</head>
<body>

@yield('body')

@stack('scripts')

</body>
</html>
