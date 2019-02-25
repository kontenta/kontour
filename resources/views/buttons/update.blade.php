<button type="{{ $type ?? 'submit' }}"
  @include('kontour::buttons.partials.buttonAttributes')
  data-kontour-action="update"
>{{ $slot ?? 'Save' }}</button>