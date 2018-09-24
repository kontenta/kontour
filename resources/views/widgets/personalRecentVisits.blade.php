<aside data-kontour-widget="PersonalRecentVisitsWidget">
  <header>Recent</header>
  <ul>
  @foreach($visits as $visit)
    <li data-kontour-visit-type="{{ $visit->getType() }}">{{ $visit->getLink() }}</li>
  @endforeach
  </ul>
</aside>
