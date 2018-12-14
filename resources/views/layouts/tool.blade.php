@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('widget_manager', 'Kontenta\Kontour\Contracts\AdminWidgetManager')

@extends($view_manager->layout())

@section('kontourMain')
  @section('kontourToolHeader')
    @foreach($widget_manager->getWidgetsForSection('kontourToolHeader') as $widget)
      {{ $widget }}
    @endforeach
  @endsection
  @hasSection('kontourToolHeader')
    <header data-kontour-section="kontourToolHeader">
      @yield('kontourToolHeader')
    </header>
  @endif

  @hasSection('kontourToolMain')
    <div data-kontour-section="kontourToolMain">
      @yield('kontourToolMain')
    </div>
  @endif

  @hasSection('kontourToolWidgets')
    <div data-kontour-section="kontourToolWidgets">
      @yield('kontourToolWidgets')
    </div>
  @endif

  @hasSection('kontourToolFooter')
    <footer data-kontour-section="kontourToolFooter">
      @yield('kontourToolFooter')
    </footer>
  @endif
@append
