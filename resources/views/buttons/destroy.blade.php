<button type="{{ $type ?? 'submit' }}"
  data-kontour-action="destroy"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? 'Delete' }}</button>