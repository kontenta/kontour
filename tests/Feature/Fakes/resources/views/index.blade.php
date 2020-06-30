@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolHeader')
<h1>A tool built for Kontour</h1>
@parent
@endsection

@section('kontourToolMain')
<ul>
  <li>Item 1</li>
  <li>Item 2</li>
</ul>
@endsection

@section('kontourToolFooter')
Tools can put content in a footer.
@parent
@endsection