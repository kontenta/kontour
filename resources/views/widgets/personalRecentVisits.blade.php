<aside data-kontour-widget="personalRecentVisits">
  <header>{{ trans('kontour::widgets.personalRecentVisits.title') }}</header>
  <ul>
  @foreach($visits as $visit)
    <li data-kontour-visit-type="{{ $visit->getType() }}"{!! empty($visit->getLink()->getDescription()) ? ' title="' . e($visit->getLink()->getName()) . '"' : '' !!}>{{ $visit->getLink() }}</li>
  @endforeach
  </ul>
</aside>
