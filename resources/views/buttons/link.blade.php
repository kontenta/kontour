<a href="{{ $href }}"
  data-kontour-button="link"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? $description }}</a>