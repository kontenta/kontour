<aside data-kontour-widget="teamRecentVisits">
  <header>Team Recent</header>
  <ul>
  @foreach($visits as $visit)
    <li data-kontour-visit-type="{{ $visit->getType() }}" data-kontour-username="{{ $visit->getUser()->getDisplayName() }}">{{ $visit->getLink() }}</li>
  @endforeach
  </ul>
</aside>
