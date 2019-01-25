name="{{ $name }}"
id="{{ $controlId }}"
@if($errors->has(str_replace('[]', '', $name)))
  aria-invalid="true"
  aria-describedby="{{ $errorsId }}"
@elseif(isset($ariaDescribedById))
  aria-describedby="{{ $ariaDescribedById }}"
@endif
@if(isset($controlAttributes) and is_iterable($controlAttributes))
  @foreach($controlAttributes as $attributeName => $attributeValue)
    @include('kontour::forms.partials.attribute')
  @endforeach
@endif