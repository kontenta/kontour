<fieldset id="{{ $groupId = $controlId ?? (($idPrefix ?? '') . $name) }}"
  data-checked-radio="{{ $selected = strval(old($name, $selected ?? $model[$name] ?? '')) }}"
>
  @include('kontour::forms.label', ['labelTag' => 'legend', 'errorsId' => $errorsId = $groupId . ($errorsSuffix ?? 'Errors')])
  @foreach($options as $option_value => $option_display)
    @if($legend = is_iterable($option_display) ? $option_value : false)
    <fieldset><legend>{{ $legend }}</legend>
    @endif
    @foreach($legend ? $option_display : [$option_value => $option_display] as $option_value => $option_display)
    @component('kontour::forms.label', ['label' => $option_display, 'controlId' => $controlId = $groupId . '[' . $option_value . ']'])
      @slot('labelStart')
        <input type="radio"
          value="{{ $option_value }}"
          @if($selected == strval($option_value))
            checked
          @endif
          @include('kontour::forms.partials.inputAttributes')
        >
      @endslot
    @endcomponent
    @endforeach
    @if($legend)
    </fieldset>
    @endif
  @endforeach
  @include('kontour::forms.partials.errors')
</fieldset>