<fieldset id="{{ $groupId = $controlId ?? (($idPrefix ?? '') . $name) }}"
  data-checked-checkboxes="{{ implode(' ', $selected = collect(old($name, $selected ?? $model[$name] ?? []))->map(function($item) { return strval($item instanceof Illuminate\Database\Eloquent\Model ? $item->getKey() : $item); })->all()) }}"
>
  @include('kontour::forms.label', ['labelTag' => 'legend', 'errorsId' => $errorsId = $groupId . ($errorsSuffix ?? 'Errors')])
  <input type="hidden" name="{{ $name }}" value="">
  @foreach($options as $option_value => $option_display)
    @if($legend = is_iterable($option_display) ? $option_value : false)
    <fieldset><legend>{{ $legend }}</legend>
    @endif
    @foreach($legend ? $option_display : [$option_value => $option_display] as $option_value => $option_display)
      @include('kontour::forms.partials.checkableOption', ['controlId' => $controlId = $groupId . '[' . $option_value . ']', 'type' => 'checkbox'])
    @endforeach
    @if($legend)
    </fieldset>
    @endif
  @endforeach
  @include('kontour::forms.partials.errors')
</fieldset>