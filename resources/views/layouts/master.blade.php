@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('widget_manager', 'Kontenta\Kontour\Contracts\AdminWidgetManager')

@extends('kontour::layouts.html')

@section('body')
  <a id="skip-to-content" href="#kontourMain" class="sr-only">{{ __('Skip to content') }}</a>

  <header data-kontour-section="kontourHeader">
    @section('kontourHeader')
      {{ \Kontenta\Kontour\AdminLink::create(config('kontour.title'), route('kontour.index'), __('View dashboard')) }}
      @foreach($widget_manager->getWidgetsForSection('kontourHeader') as $widget)
        {{ $widget }}
      @endforeach
    @show
  </header>

  @section('kontourNav')
    @foreach($widget_manager->getWidgetsForSection('kontourNav') as $widget)
      {{ $widget }}
    @endforeach
  @endsection
  @hasSection('kontourNav')
    <nav data-kontour-section="kontourNav">
      @yield('kontourNav')
    </nav>
  @endif


  <main data-kontour-section="kontourMain" id="kontourMain">
    @yield('kontourMain')
  </main>

  @section('kontourWidgets')
    @foreach($widget_manager->getWidgetsForSection('kontourWidgets') as $widget)
      {{ $widget }}
    @endforeach
  @endsection
  @hasSection('kontourWidgets')
    <section data-kontour-section="kontourWidgets">
      @yield('kontourWidgets')
    </section>
  @endif

  <footer data-kontour-section="kontourFooter">
    @section('kontourFooter')
      @foreach($widget_manager->getWidgetsForSection('kontourFooter') as $widget)
        {{ $widget }}
      @endforeach
    @show
  </footer>
@endsection

@push('styles')
  @foreach($view_manager->getStylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet">
  @endforeach
@endpush

@push('scripts')
  @foreach($view_manager->getJavascriptUrls() as $javascript)
    <script src="{{ url($javascript) }}"></script>
  @endforeach
@endpush
