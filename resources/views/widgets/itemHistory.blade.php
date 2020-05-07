<section data-kontour-widget="itemHistory">
  <header>{{ trans('kontour::widgets.itemHistory.title') }}</header>
  <ul role="list">
  @foreach($entries as $entry)
    <li lang="en" data-kontour-entry-action="{{ $entry['action'] }}"@if($entry['user']) data-kontour-username="{{ $entry['user']->getDisplayName() }}"@endif>
        <span>{{ ucfirst($entry['action']) }}</span>
        @include('kontour::elements.time', ['carbon' => $entry['datetime']])
        @if($entry['user'])
            <span>by</span> <span>{{ $entry['user']->getDisplayName() }}</span>
        @endif
    </li>
  @endforeach
  </ul>
</section>
