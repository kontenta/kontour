@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('widget_manager', 'Kontenta\Kontour\Contracts\AdminWidgetManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  @section($view_manager->toolHeaderSection())
    @foreach($widget_manager->getWidgetsForSection($view_manager->toolHeaderSection()) as $widget)
      {{ $widget }}
    @endforeach
  @endsection
  @hasSection($view_manager->toolHeaderSection())
    <header data-kontour-section="{{ $view_manager->toolHeaderSection() }}">
      @yield($view_manager->toolHeaderSection())
    </header>
  @endif

  @hasSection($view_manager->toolMainSection())
    <div data-kontour-section="{{ $view_manager->toolMainSection() }}">
      @yield($view_manager->toolMainSection())
    </div>
  @endif

  @hasSection($view_manager->toolWidgetSection())
    <div data-kontour-section="{{ $view_manager->toolWidgetSection() }}">
      @yield($view_manager->toolWidgetSection())
    </div>
  @endif

  @hasSection($view_manager->toolFooterSection())
    <footer data-kontour-section="{{ $view_manager->toolFooterSection() }}">
      @yield($view_manager->toolFooterSection())
    </footer>
  @endif
@append
