@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section('kontourMain')
  <header>{{ __('Reset Password') }}</header>
  <form method="POST" action="{{ route('kontour.password.request') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password_confirmation', 'type' => 'password', 'controlAttributes' => ['required']])
    @component('kontour::buttons.generic')
      {{ __('Reset Password') }}
    @endcomponent
  </form>
@endsection