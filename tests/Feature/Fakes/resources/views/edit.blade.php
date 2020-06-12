@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section('kontourToolMain')
<form>
  @include('kontour::forms.input', ['name' => 'test', 'value' => 'An example'])
  @include('kontour::forms.radiobuttons', ['name' => 'radios', 'label' => 'Some options',
  'options' => ['This is a choice you can make', 'The second one is also a possibility', 'Last option']])
  @include('kontour::forms.checkboxes', ['name' => 'checkboxes', 'label' => 'Select multiple things',
  'options' => ['Item A', 'Item B', 'Item C']])
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