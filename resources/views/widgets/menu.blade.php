<ul data-kontour-widget="menu">
@foreach($links as $heading => $headingLinks)
  <li>
    <span>{{ $heading }}</span>
    <ul>
    @foreach($headingLinks as $link)
      <li>{{ $link }}</li>
    @endforeach
    </ul>
  </li>
@endforeach
</ul>
