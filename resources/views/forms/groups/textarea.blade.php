<{{ $groupTag = $groupTag ?? 'div' }}
  @include('kontour::forms.partials.groupAttributes')
>
  @include('kontour::forms.label', [
    'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name),
  ])
  <div>
    {{ $beforeControl ?? '' }}
    <textarea
      @include('kontour::forms.partials.inputAttributes', [
        'errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors'),
      ])
    >{{ ($errors->any() ? old($name) : null) ?? $value ?? $slot ?? $model[$name] ?? '' }}</textarea>
    {{ $afterControl ?? '' }}
    @include('kontour::forms.partials.errors')
  </div>
</{{ $groupTag }}>