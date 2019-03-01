@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
  <form>
    @include('kontour::forms.input', ['name' => 'test'])
  </form>
@endsection
