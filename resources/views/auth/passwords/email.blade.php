@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

<?php
  $autofocusControlId = 'email';
?>

@section('kontourMain')
  <header>{{ __('Reset Password') }}</header>

  {{ $messageWidget }}

  <form method="POST" action="{{ route('kontour.password.email') }}">
    @csrf
    @include('kontour::forms.email', ['controlAttributes' => ['required']])
    @component('kontour::buttons.generic')
      {{ __('Send Password Reset Link') }}
    @endcomponent
  </form>
@endsection