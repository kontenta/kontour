<button type="submit"
  @include('kontour::buttons.partials.buttonAttributes')
>
  <svg viewBox="0 0 10 10" aria-hidden="true">
    <polygon points="1,1 1,9 6,9 6,7 5,7 5,8 2,8 2,2 5,2 5,3, 6,3 6,1" />
    <polygon points="3,4 7,4 7,2 9,5 7,8 7,6 3,6" />
  </svg>
  <span class="sr-only">{{ __('Logout') }}</span>
</button>