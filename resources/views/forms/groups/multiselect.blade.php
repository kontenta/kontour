<{{ $groupTag = $groupTag ?? 'div' }}
  data-selected-options="{{ implode(' ', $selected = collect(($errors->any() ? old($name) : null) ?? $selected ?? $model[$name] ?? [])->map(function($item) { return strval($item instanceof Illuminate\Database\Eloquent\Model ? $item->getKey() : $item); })->all()) }}"
  @include('kontour::forms.partials.groupAttributes')
>
  <input type="hidden" @include('kontour::forms.partials.nameAttribute') value="">
  @include('kontour::forms.label', [
    'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name),
  ])
  <div>
    {{ $beforeControl ?? '' }}
    <select multiple
      @include('kontour::forms.partials.inputAttributes', [
        'name' => $name . '[]',
        'errorsKeys' => $errorsKeys = $errorsKeys ?? [$name, $name . '.*'],
        'errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors'),
      ])
    >
      @include('kontour::forms.partials.options')
    </select>
    {{ $afterControl ?? '' }}
    @include('kontour::forms.partials.errors')
  </div>
</{{ $groupTag }}>