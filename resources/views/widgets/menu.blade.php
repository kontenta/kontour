<ul data-kontour-widget="menu">
@foreach($links as $heading => $headingLinks)
  @if(count($headingLinks))
    <li>
      <small>{{ $heading }}</small>
      <ul>
      @foreach($headingLinks as $link)
        <li{!! preg_match('#'.$link->getUrl().'#', url()->full()) ? ' aria-current="' . (url()->full() == $link->getUrl() ? 'page' : 'true') . '"' : '' !!}>{{ $link }}</li>
      @endforeach
      </ul>
    </li>
  @endif
@endforeach
</ul>
