<aside data-kontour-widget="teamRecentVisits">
  <header>{{ trans('kontour::widgets.teamRecentVisits.title') }}</header>
  <ul>
  @foreach($visits as $visit)
    <li data-kontour-visit-type="{{ $visit->getType() }}" data-kontour-username="{{ $visit->getUser()->getDisplayName() }}"{!! empty($visit->getLink()->getDescription()) ? ' title="' . e($visit->getLink()->getName()) . '"' : '' !!}>{{ $visit->getLink() }}</li>
  @endforeach
  </ul>
</aside>
