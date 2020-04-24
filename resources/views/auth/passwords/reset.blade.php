@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

<?php
  $autofocusControlId = array_merge(array_intersect(['email', 'password'], $errors->keys()), ['email'])[0];
?>

@section('kontourMain')
<header>{{ __('Reset Password') }}</header>
<form method="POST" action="{{ route('kontour.password.request') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => [
  'required',
  'autocomplete' => 'email',
  'autocapitalize' => 'none',
  'autocorrect'=>'off',
  ]])
  @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => [
  'required',
  'autocomplete' => 'new-password'
  ]])
  @include('kontour::forms.input', ['name' => 'password_confirmation', 'type' => 'password', 'controlAttributes' => [
  'required',
  'autocomplete' => 'new-password'
  ]])
  @component('kontour::buttons.generic')
  {{ __('Reset Password') }}
  @endcomponent
</form>
@endsection