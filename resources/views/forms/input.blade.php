<div>
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    <input type="{{ $type ?? 'text' }}"
      value="{{ old($name, $value ?? $slot ?? $model[$name] ?? '') }}"
      @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >
    @include('kontour::forms.partials.errors', ['errorsId' => $errorsId])
  </div>
</div>
