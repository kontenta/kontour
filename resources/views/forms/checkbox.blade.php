<div>
  @component('kontour::forms.label', ['name' => $name, 'label' => $label ?? null, 'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name), 'labelAttributes' => $labelAttributes ?? []])
    @slot('labelStart')
      @include('kontour::forms.partials.checkbox', ['errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    @endslot
  @endcomponent
  @include('kontour::forms.partials.errors')
</div>