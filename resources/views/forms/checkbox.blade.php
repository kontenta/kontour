<div>
  @component('kontour::forms.label', ['name' => $name, 'label' => $label ?? null, 'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
    @slot('labelStart')
      <input type="checkbox"
        @if(old($name, $checked ?? $model[$name] ?? false))
          checked
        @endif
        value="{{ $value ?? $checkbox_default_value ?? '1' }}"
        @include('kontour::forms.partials.inputAttributes', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
      >
    @endslot
  @endcomponent
  @include('kontour::forms.partials.errors', ['errorsId' => $errorsId])
</div>
