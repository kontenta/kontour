<input type="checkbox"
  @if(old($name, $checked ?? $model[$name] ?? false))
    checked
  @endif
  value="{{ $value ?? $checkboxDefaultValue ?? '1' }}"
  @include('kontour::forms.partials.inputAttributes')
>