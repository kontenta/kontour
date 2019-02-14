<fieldset id="{{ $groupId = $controlId ?? (($idPrefix ?? '') . $name) }}"
  data-checked-radio="{{ $selected = strval(old($name, $selected ?? $model[$name] ?? '')) }}"
  @include('kontour::forms.partials.groupAttributes')
>
  @include('kontour::forms.elements.label', [
    'labelTag' => 'legend',
    'errorsId' => $errorsId = $groupId . ($errorsSuffix ?? 'Errors'),
    'labelAttributes' => $legendAttributes ?? [],
  ])
  @include('kontour::forms.partials.checkableOptions')
  @include('kontour::forms.partials.errors')
</fieldset>