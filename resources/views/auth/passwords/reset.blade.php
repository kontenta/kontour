@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  <header>{{ __('Reset Password') }}</header>
  <form method="POST" action="{{ route('kontour.password.request') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => ['required']])
    @include('kontour::forms.input', ['name' => 'password_confirmation', 'type' => 'password', 'controlAttributes' => ['required']])
    <button type="submit">
      {{ __('Reset Password') }}
    </button>
  </form>
@endsection