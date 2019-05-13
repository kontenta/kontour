<{{ $groupTag = $groupTag ?? 'div' }}
  data-selected-option="{{ $selected = strval(($errors->any() ? old($name) : null) ?? $selected ?? $model[$name] ?? '') }}"
  @include('kontour::forms.partials.groupAttributes')
>
  @include('kontour::forms.label', [
    'controlId' => $controlId = $controlId ?? (($idPrefix ?? '') . $name),
  ])
  <div>
    {{ $beforeControl ?? '' }}
    <select
      @include('kontour::forms.partials.inputAttributes', [
        'errorsId' => $errorsId = $controlId . ($errorsSuffix ?? 'Errors'),
      ])
    >
      @include('kontour::forms.partials.options', [
        'options' => (empty($placeholder) or collect($options)->flatten()->has('')) ?
        $options :
        array_merge(['' => $placeholder], $options)
      ])
    </select>
    {{ $afterControl ?? '' }}
    @include('kontour::forms.partials.errors')
  </div>
</{{ $groupTag }}>