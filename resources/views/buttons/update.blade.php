<button type="{{ $type ?? 'submit' }}"
  @include('kontour::buttons.partials.buttonAttributes')
  data-kontour-button="update"
>{{ $slot ?? __('Save') }}</button>