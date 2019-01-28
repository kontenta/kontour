<{{ $groupTag = $groupTag ?? 'div' }}
  data-selected-options="{{ implode(' ', $selected = collect(old($name, $selected ?? $model[$name] ?? []))->map(function($item) { return strval($item instanceof Illuminate\Database\Eloquent\Model ? $item->getKey() : $item); })->all()) }}"
  @include('kontour::forms.partials.groupAttributes')
>
  <input type="hidden" name="{{ $name }}" value="">
  @include('kontour::forms.label', ['controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name)])
  <div>
    {{ $beforeControl ?? '' }}
    <select multiple
      @include('kontour::forms.partials.inputAttributes', ['name' => $name . '[]', 'errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors')])
    >
      @include('kontour::forms.partials.options')
    </select>
    {{ $afterControl ?? '' }}
    @include('kontour::forms.partials.errors')
  </div>
</{{ $groupTag }}>