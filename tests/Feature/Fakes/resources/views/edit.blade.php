@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
  <form>
    @include('kontour::forms.input', ['name' => 'test', 'value' => 'An example'])
    @include('kontour::buttons.update')
  </form>
@endsection
