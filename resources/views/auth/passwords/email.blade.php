@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section('kontourMain')
  <header>{{ __('Reset Password') }}</header>

  {{ $messageWidget }}

  <form method="POST" action="{{ route('kontour.password.email') }}">
    @csrf
    @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
    <button type="submit" class="btn btn-primary">
      {{ __('Send Password Reset Link') }}
    </button>
  </form>
@endsection