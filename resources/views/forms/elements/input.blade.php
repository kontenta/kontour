<input type="{{ $type = $type ?? 'text' }}"
  @if($type != 'password')
    value="{{ old($name, $value ?? $slot ?? $model[$name] ?? '') }}"
  @endif
  @include('kontour::forms.partials.inputAttributes')
>