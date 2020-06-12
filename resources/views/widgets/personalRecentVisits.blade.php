@if(count($visits))
  <aside data-kontour-widget="personalRecentVisits">
    <header>{{ trans('kontour::widgets.personalRecentVisits.title') }}</header>
    <ul role="list">
    @foreach($visits as $visit)
      @if(url()->full() != $visit->getLink()->getUrl())
        <li data-kontour-visit-type="{{ $visit->getType() }}"{!! empty($visit->getLink()->getDescription()) ? ' title="' . e($visit->getLink()->getName()) . '"' : '' !!}><small>{{ $visit->getLink() }}</small></li>
      @endif
    @endforeach
    </ul>
  </aside>
@endif