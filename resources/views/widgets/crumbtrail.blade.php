<nav aria-label="{{ __('Crumb trail') }}" data-kontour-widget="crumbtrail">
  <ol role="list">
    @foreach($links as $link)
      <li{!! url()->full() == $link->getUrl() ? ' aria-current="true"' : '' !!}>{{ $link }}</li>
    @endforeach
  </ol>
</nav>
