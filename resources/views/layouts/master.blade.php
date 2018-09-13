@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('widget_manager', 'Kontenta\Kontour\Contracts\AdminWidgetManager')

@extends('kontour::layouts.html')

@section('body')
  <header>
    {{-- TODO: make this logout form part of a user-widget --}}
    <form action="{{ route('kontour.logout') }}" method="post">
      {{ csrf_field() }}
      <button type="submit">Logout</button>
    </form>
  </header>
  <nav>
    @foreach($widget_manager->getWidgetsForSection($view_manager->navSection()) as $widget)
      {{ $widget }}
    @endforeach
  </nav>
  <main>
  <!-- Section {{ $view_manager->mainSection() }} -->
  @yield($view_manager->mainSection())
  <!-- End section {{ $view_manager->mainSection() }} -->
  </main>
  <aside>
  @section($view_manager->widgetSection())
    @foreach($widget_manager->getWidgetsForSection($view_manager->widgetSection()) as $widget)
      {{ $widget }}
    @endforeach
  @show
  </aside>
@endsection

@push('styles')
  @foreach($view_manager->getStylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
