<input type="{{ $type = $type ?? 'text' }}"
  @if($type != 'password')
    value="{{ ($errors->any() ? old($name) : null) ?? $value ?? $slot ?? $model[$name] ?? '' }}"
  @endif
  @include('kontour::forms.partials.inputAttributes')
>