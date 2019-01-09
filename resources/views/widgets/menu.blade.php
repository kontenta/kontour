<ul data-kontour-widget="menu">
@foreach($links as $heading => $headingLinks)
  <li>
    <span>{{ $heading }}</span>
    <ul>
    @foreach($headingLinks as $link)
      <li{!! url()->full() == $link->getUrl() ? ' aria-current="page"' : '' !!}>{{ $link }}</li>
    @endforeach
    </ul>
  </li>
@endforeach
</ul>
