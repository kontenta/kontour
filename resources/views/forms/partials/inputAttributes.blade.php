name="{{ preg_replace('/\.([^\.]*)/', '[$1]', $name) }}"
id="{{ $controlId }}"
@if($errors->hasAny($errorsKeys ?? $name))
  aria-invalid="true"
  aria-describedby="{{ $errorsId }}"
@elseif(isset($ariaDescribedById))
  aria-describedby="{{ $ariaDescribedById }}"
@endif
@if(!empty($autofocusControlId) and $autofocusControlId == $controlId)
  autofocus
@endif
@if(isset($controlAttributes) and is_iterable($controlAttributes))
  @foreach($controlAttributes as $attributeName => $attributeValue)
    @include('kontour::partials.attribute')
  @endforeach
@endif