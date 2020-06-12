@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
<form>
  @include('kontour::forms.input', ['name' => 'test', 'value' => 'An example'])
  <div data-kontour-section="kontourStickyActions">
    <div class="cluster">
      <div>
        @include('kontour::buttons.update')
        @include('kontour::buttons.destroy')
      </div>
    </div>
  </div>
</form>
@endsection