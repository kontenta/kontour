<button type="{{ $type ?? 'submit' }}"
  @if(isset($description))
    aria-label="{{ $description }}"
  @endif
  data-kontour-action="delete"
>{{ $slot ?? 'Delete' }}</button>