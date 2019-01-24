<input type="checkbox"
  @if(old($name, $checked ?? $model[$name] ?? false))
    checked
  @endif
  value="{{ $value ?? $checkbox_default_value ?? '1' }}"
  @include('kontour::forms.partials.inputAttributes')
>