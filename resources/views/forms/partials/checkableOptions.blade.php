@foreach($options as $option_value => $option_display)
  @if($legend = is_iterable($option_display) ? $option_value : false)
  <fieldset><legend>{{ $legend }}</legend>
  @endif
  @foreach($legend ? $option_display : [$option_value => $option_display] as $option_value => $option_display)
    @include('kontour::forms.partials.checkableOption', ['controlId' => $controlId = $groupId . '[' . $option_value . ']'])
  @endforeach
  @if($legend)
  </fieldset>
  @endif
@endforeach