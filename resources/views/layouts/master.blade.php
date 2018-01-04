@inject('view_manager', 'Erik\AdminManager\Contracts\AdminViewManager')

@extends('admin::layouts.html')

@section('body')
  <main>
    <!-- Section {{ $view_manager->mainSection() }} -->
    @yield($view_manager->mainSection())
    <!-- End section {{ $view_manager->mainSection() }} -->
  </main>
@endsection

@push('styles')
  @foreach($view_manager->getStylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
