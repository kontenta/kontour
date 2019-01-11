<aside data-kontour-widget="personalRecentVisits">
  <header>{{ trans('kontour::widgets.personalRecentVisits.title') }}</header>
  <ul>
  @foreach($visits as $visit)
    @if(url()->full() != $visit->getLink()->getUrl())
      <li data-kontour-visit-type="{{ $visit->getType() }}"{!! empty($visit->getLink()->getDescription()) ? ' title="' . e($visit->getLink()->getName()) . '"' : '' !!}>{{ $visit->getLink() }}</li>
    @endif
  @endforeach
  </ul>
</aside>
