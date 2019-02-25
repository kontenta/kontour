<button type="{{ $type ?? 'submit' }}"
  @if(isset($description))
    aria-label="{{ $description }}"
  @endif
  data-kontour-action="destroy"
>{{ $slot ?? 'Delete' }}</button>