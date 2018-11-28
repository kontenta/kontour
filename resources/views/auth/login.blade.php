@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')
@inject('route_manager', 'Kontenta\Kontour\Contracts\AdminRouteManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kontour.login') }}">
                      @csrf
                      @include('kontour::forms.input', ['name' => 'email', 'type' => 'email', 'controlAttributes' => ['required']])
                      @include('kontour::forms.input', ['name' => 'password', 'type' => 'password', 'controlAttributes' => ['required']])
                      @include('kontour::forms.checkbox', ['name' => 'remember', 'label' => __('Remember Me')])
                      <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                      </button>
                      @if($route_manager->passwordResetUrl())
                        <a class="btn btn-link" href="{{ $route_manager->passwordResetUrl() }}">
                          {{ __('Forgot Your Password?') }}
                        </a>
                      @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
