<section data-kontour-widget="itemHistory">
  <header>Item History</header>
  <ul>
  @foreach($entries as $entry)
    <li lang="en" data-kontour-entry-action="{{ $entry['action'] }}"@if($entry['user']) data-kontour-username="{{ $entry['user']->getDisplayName() }}"@endif>
        <span>{{ $entry['action'] }}</span>
        <time datetime="{{ $entry['datetime']->toDateTimeString() }}">{{ $entry['datetime']->diffForHumans() }}</time>
        @if($entry['user'])
            <span>by</span> <span>{{ $entry['user']->getDisplayName() }}</span>
        @endif
    </li>
  @endforeach
  </ul>
</section>
