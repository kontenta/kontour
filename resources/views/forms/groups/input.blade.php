<div>
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    {{ $beforeControl ?? '' }}
    @include('kontour::forms.elements.input', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    {{ $afterControl ?? '' }}
    @include('kontour::forms.partials.errors')
  </div>
</div>