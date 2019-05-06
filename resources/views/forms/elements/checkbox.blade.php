<input type="checkbox"
  @if(($errors->any() ? old($name) : null) ?? $checked ?? $model[$name] ?? false))
    checked
  @endif
  value="{{ $value ?? $checkboxDefaultValue ?? '1' }}"
  @include('kontour::forms.partials.inputAttributes')
>