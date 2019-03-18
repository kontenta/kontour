@foreach($options as $option_value => $option_display)
  @if($legend = is_iterable($option_display) ? $option_value : false)
  <fieldset><legend>{{ $legend }}</legend>
  @endif
  @foreach($legend ? $option_display : [$option_value => $option_display] as $option_value => $option_display)
    @include('kontour::forms.partials.checkableOption', [
      'optionIndex' => $optionIndex = isset($optionIndex) ? $optionIndex + 1 : 0,
      'optionErrorKey' => $optionErrorKey = $name . '.' . $optionIndex,
      'errorsId' => $errors->has($optionErrorKey) ? $errorsId . '.' . $optionIndex : $errorsId,
      'errorsKeys' => $errors->has($optionErrorKey) ? $optionErrorKey : ($errorsKeys ?? $name),
    ])
  @endforeach
  @if($legend)
  </fieldset>
  @endif
@endforeach