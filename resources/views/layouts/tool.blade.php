@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  @yield($view_manager->toolHeaderSection())
  
  @yield($view_manager->toolMainSection())

  @yield($view_manager->toolWidgetSection())
  
  @yield($view_manager->toolFooterSection())
@append
