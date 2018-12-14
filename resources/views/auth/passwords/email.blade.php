@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section('kontourMain')
  <header>{{ __('Reset Password') }}</header>

  {{-- TODO: Use the MessageWidget instead of hard coded alert from session --}}
  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('kontour.password.email') }}">
    @csrf
    @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
    <button type="submit" class="btn btn-primary">
      {{ __('Send Password Reset Link') }}
    </button>
  </form>
@endsection