@if(count($visits))
  <aside data-kontour-widget="personalRecentVisits">
    <header>{{ trans('kontour::widgets.personalRecentVisits.title') }}</header>
    <ul role="list">
    @foreach($visits as $visit)
      @if(url()->full() != $visit->getLink()->getUrl())
        <li data-kontour-visit-type="{{ $visit->getType() }}">{{ $visit->getLink() }}</li>
      @endif
    @endforeach
    </ul>
  </aside>
@endif