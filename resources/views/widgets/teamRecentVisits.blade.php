@if(count($visits))
  <aside data-kontour-widget="teamRecentVisits">
    <header>{{ trans('kontour::widgets.teamRecentVisits.title') }}</header>
    <ul role="list">
    @foreach($visits as $visit)
      <li data-kontour-visit-type="{{ $visit->getType() }}" data-kontour-username="{{ $visit->getUser()->getDisplayName() }}"><small>{{ $visit->getLink() }}</small></li>
    @endforeach
    </ul>
  </aside>
@endif