<div>
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    <input type="{{ $type = $type ?? 'text' }}"
      @if($type != 'password')
        value="{{ old($name, $value ?? $slot ?? $model[$name] ?? '') }}"
      @endif
      @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >
    @include('kontour::forms.partials.errors', ['errorsId' => $errorsId])
  </div>
</div>