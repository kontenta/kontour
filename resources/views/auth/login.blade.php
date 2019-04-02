@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('route_manager', 'Kontenta\Kontour\Contracts\AdminRouteManager')

@extends($view_manager->layout())

@section('kontourMain')
  <header>{{ __('Login') }}</header>
  <form method="POST" action="{{ route('kontour.login') }}">
    @csrf
    @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => ['required']])
    @include('kontour::forms.checkbox', ['name' => 'remember', 'label' => __('Remember Me')])
    @component('kontour::buttons.generic')
      {{ __('Login') }}
    @endcomponent
    @if($route_manager->passwordResetUrl())
      <a href="{{ $route_manager->passwordResetUrl() }}">
        {{ __('Forgot Your Password?') }}
      </a>
    @endif
  </form>
@endsection