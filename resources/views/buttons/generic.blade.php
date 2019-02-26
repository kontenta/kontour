<button type="{{ $type = $type ?? 'submit' }}"
  @include('kontour::buttons.partials.buttonAttributes')
  data-kontour-button="{{ $type }}"
>{{ $slot ?? $description }}</button>
