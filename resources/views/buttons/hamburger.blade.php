<button aria-expanded="true" hidden
  @include('kontour::buttons.partials.buttonAttributes')
>
  <svg viewBox="0 0 10 10" aria-hidden="true">
    <rect class="top" height="2" width="8" y="1" x="1"/>
    <rect class="middle" height="2" width="8" y="4" x="1"/>
    <rect class="bottom" height="2" width="8" y="7" x="1"/>
  </svg>
  <span class="sr-only">{{ __('Open menu') }}</span>
</button>