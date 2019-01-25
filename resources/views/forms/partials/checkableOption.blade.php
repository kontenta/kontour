@component('kontour::forms.label', ['label' => $option_display, 'controlId' => $controlId = $groupId . '[' . $option_value . ']', 'labelAttributes' => $labelAttributes ?? []])
  @slot('labelStart')
    <input type="{{ is_array($selected) ? 'checkbox' : 'radio' }}"
      value="{{ $option_value }}"
      @if(is_array($selected) ? in_array(strval($option_value), $selected) : $selected == strval($option_value))
        checked
      @endif
      @include('kontour::forms.partials.inputAttributes', ['name' => is_array($selected) ? $name . '[]' : $name])
    >
  @endslot
@endcomponent