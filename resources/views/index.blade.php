@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section('kontourMain')
  @include('kontour::dashboard.welcome')
  @include('kontour::dashboard.laravelConfig')
@append
