@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
@endsection

