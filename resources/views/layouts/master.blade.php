@inject('view_manager', 'Erik\AdminManager\Contracts\ViewManager')

@extends('admin::layouts.html')

@section('body')
  <main>
    <!-- Section {{ $view_manager->getMainSection() }} -->
    @yield($view_manager->getMainSection())
    <!-- End section {{ $view_manager->getMainSection() }} -->
  </main>
@endsection

