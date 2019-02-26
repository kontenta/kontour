<a href="{{ $href }}"
  @if(isset($description))
    title="{{ $description }}"
  @endif
  data-kontour-action="link"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? $description }}</a>