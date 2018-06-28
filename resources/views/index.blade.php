@inject('view_manager', 'Kontenta\AdminManager\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  The admin index page
@append
