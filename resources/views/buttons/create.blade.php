<button type="{{ $type ?? 'submit' }}"
  data-kontour-button="create"
  @include('kontour::buttons.partials.buttonAttributes')
>{{ $slot ?? __('Create new') }}</button>