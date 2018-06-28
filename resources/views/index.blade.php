@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  The admin index page
@append
