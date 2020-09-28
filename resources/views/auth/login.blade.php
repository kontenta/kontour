@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('route_manager', 'Kontenta\Kontour\Contracts\AdminRouteManager')

@extends($view_manager->layout())

<?php
  $autofocusControlId = 'email';
?>

@section('kontourMain')
  <header>{{ __('Log in') }}</header>
  <form method="POST" action="{{ route('kontour.login') }}">
    @csrf
    @include('kontour::forms.email', ['controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => ['required', 'autocomplete' => 'current-password']])
    @include('kontour::forms.checkbox', ['name' => 'remember', 'label' => __('Remember Me')])
    @component('kontour::buttons.generic')
      {{ __('Log in') }}
    @endcomponent
    @if($route_manager->passwordResetUrl())
      <a href="{{ $route_manager->passwordResetUrl() }}">
        {{ __('Forgot Your Password?') }}
      </a>
    @endif
  </form>
@endsection