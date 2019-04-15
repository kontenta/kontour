@component('kontour::forms.elements.label', [
    'label' => $option_display,
    'controlId' => $controlId = $groupId . '.' . $optionIndex,
    'labelAttributes' => $labelAttributes ?? [],
  ])
  @slot('labelStart')
    <input type="{{ is_array($selected) ? 'checkbox' : 'radio' }}"
      value="{{ $option_value }}"
      @if(is_array($selected) ? in_array(strval($option_value), $selected) : $selected == strval($option_value))
        checked
      @endif
      @if(!empty($disabledOptions) and is_array($disabledOptions) and in_array(strval($option_value), $disabledOptions))
        disabled
      @endif
      @include('kontour::forms.partials.inputAttributes', [
        'name' => is_array($selected) ? $name . '[]' : $name,
        'autofocusControlId' => empty($autofocusControlId) ? null : ($autofocusControlId == $groupId ? $autofocusControlId . '.0' : $autofocusControlId),
      ])
    >
  @endslot
@endcomponent
@if($errorsKeys == $optionErrorKey)
  @include('kontour::forms.partials.errors')
@endif