<{{ $groupTag = $groupTag ?? 'div' }}
  @include('kontour::forms.partials.groupAttributes')
>
  @component('kontour::forms.elements.label', [
    'name' => $name,
    'label' => $label ?? null,
    'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name),
    'labelAttributes' => $labelAttributes ?? [],
  ])
    @slot('labelStart')
      @include('kontour::forms.elements.checkbox', [
        'errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors'),
      ])
    @endslot
  @endcomponent
  @include('kontour::forms.partials.errors')
</{{ $groupTag }}>