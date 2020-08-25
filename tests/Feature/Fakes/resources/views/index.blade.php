@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolHeader')
<h1>A tool built for Kontour</h1>
@parent
@endsection

@section('kontourToolMain')
<ul>
  <li><a href="">Edit item 1</a></li>
  <li><a href="">Edit item 2</a></li>
</ul>
@endsection

@section('kontourToolFooter')
Tools can put content in a footer.
@parent
@endsection