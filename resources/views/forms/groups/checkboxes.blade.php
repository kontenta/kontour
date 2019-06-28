<fieldset id="{{ $groupId = $controlId ?? (($idPrefix ?? '') . $name) }}"
  data-checked-checkboxes="{{ implode(' ', $selected = collect(($errors->any() ? old($name) : null) ?? $selected ?? $model[$name] ?? [])->map(function($item) { return strval($item instanceof Illuminate\Database\Eloquent\Model ? $item->getKey() : $item); })->all()) }}"
  @include('kontour::forms.partials.groupAttributes')
>
  @include('kontour::forms.elements.label', [
    'labelTag' => 'legend',
    'errorsId' => $errorsId = $groupId . ($errorsSuffix ?? 'Errors'),
    'labelAttributes' => $legendAttributes ?? [],
  ])
  <input type="hidden" @include('kontour::forms.partials.nameAttribute') value="">
  @include('kontour::forms.partials.checkableOptions')
  @include('kontour::forms.partials.errors')
</fieldset>