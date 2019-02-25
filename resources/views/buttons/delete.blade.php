<button type="{{ $type ?? 'submit' }}"
  @if(isset($description))
    aria-label="{{ $description }}"
  @endif
>
  {{ $slot ?? 'Delete' }}
</button>