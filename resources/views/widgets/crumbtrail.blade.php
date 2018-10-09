<nav aria-label="Crumb trail" data-kontour-widget="crumbtrail">
  <ol>
    @foreach($links as $link)
      <li{!! url()->full() == $link->getUrl()?' aria-current="page"':'' !!}>{{ $link }}</li>
    @endforeach
  </ol>
</nav>
