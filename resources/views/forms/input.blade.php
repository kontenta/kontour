<div>
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    @include('kontour::forms.partials.input', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    @include('kontour::forms.partials.errors')
  </div>
</div>