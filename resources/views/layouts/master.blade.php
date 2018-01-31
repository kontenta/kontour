@inject('view_manager', 'Erik\AdminManager\Contracts\AdminViewManager')

@extends('admin::layouts.html')

@section('body')
  <header>
    {{-- TODO: make this logout form part of a user-widget --}}
    <form action="{{ route('admin.logout') }}" method="post">
      {{ csrf_field() }}
      <button type="submit">Logout</button>
    </form>
  </header>
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
