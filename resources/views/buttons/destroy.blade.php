<button type="{{ $type ?? 'submit' }}"
  data-kontour-button="destroy"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? 'Delete' }}</button>