<div>
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    <textarea
      @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >{{ old($name, $value ?? $slot ?? $model[$name] ?? '') }}</textarea>
    @include('kontour::forms.partials.errors')
  </div>
</div>