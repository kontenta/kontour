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
  <nav data-kontour-section="{{ $view_manager->navSection() }}">
    @foreach($widget_manager->getWidgetsForSection($view_manager->navSection()) as $widget)
      {{ $widget }}
    @endforeach
  </nav>
  <main data-kontour-section="{{ $view_manager->mainSection() }}">
  @yield($view_manager->mainSection())
  </main>
  <section data-kontour-section="{{ $view_manager->widgetSection() }}">
  @section($view_manager->widgetSection())
    @foreach($widget_manager->getWidgetsForSection($view_manager->widgetSection()) as $widget)
      {{ $widget }}
    @endforeach
  @show
  </section>
@endsection

@push('styles')
  @foreach($view_manager->getStylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
