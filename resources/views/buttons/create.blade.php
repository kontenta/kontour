<button type="{{ $type ?? 'submit' }}"
  data-kontour-action="create"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? 'Create new' }}</button>