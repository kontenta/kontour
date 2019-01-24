@component('kontour::forms.label', ['label' => $option_display, 'controlId' => $controlId = $groupId . '[' . $option_value . ']', 'labelAttributes' => $labelAttributes ?? []])
  @slot('labelStart')
    <input type="{{ $type = $type ?? 'radio' }}"
      value="{{ $option_value }}"
      @if($type == 'checkbox' ?  in_array(strval($option_value), $selected) : $selected == strval($option_value))
        checked
      @endif
      @include('kontour::forms.partials.inputAttributes', ['name' => $type == 'checkbox' ? $name . '[]' : $name])
    >
  @endslot
@endcomponent