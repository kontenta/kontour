@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
<form>
  @include('kontour::forms.input', ['name' => 'test', 'value' => 'An example'])
  @include('kontour::forms.radiobuttons', ['name' => 'options', 'label' => 'Some options',
  'options' => ['This is a choice you can make', 'This is another', 'Last chance here...']])
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