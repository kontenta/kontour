<div data-selected-option="{{ $selected = strval(old($name, $selected ?? $model[$name] ?? '')) }}">
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    <select
      @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >
      @foreach($options as $option_value => $option_display)
        @if($optgroup = is_iterable($option_display) ? $option_value : false)
        <optgroup label="{{ $optgroup }}">
        @endif
        @foreach($optgroup ? $option_display : [$option_value => $option_display] as $option_value => $option_display)
        <option
          value="{{ $option_value }}"
          @if($selected == strval($option_value))
            selected
          @endif
        >{{ $option_display }}</option>
        @endforeach
        @if($optgroup)
        </optgroup>
        @endif
      @endforeach
    </select>
    @include('kontour::forms.partials.errors', ['errorsId' => $errorsId])
  </div>
</div>