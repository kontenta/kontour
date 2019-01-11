<ul data-kontour-widget="menu">
@foreach($links as $heading => $headingLinks)
  @if(count($headingLinks))
    <li>
      <small>{{ $heading }}</small>
      <ul>
      @foreach($headingLinks as $link)
        <li{!! url()->full() == $link->getUrl() ? ' aria-current="page"' : '' !!}>{{ $link }}</li>
      @endforeach
      </ul>
    </li>
  @endif
@endforeach
</ul>
