<div data-selected-option="{{ $selected = strval(old($name, $selected ?? $model[$name] ?? '')) }}">
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    <select
      @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >
      @include('kontour::forms.partials.options')
    </select>
    @include('kontour::forms.partials.errors', ['errorsId' => $errorsId])
  </div>
</div>