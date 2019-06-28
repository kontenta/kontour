@include('kontour::forms.partials.nameAttribute')
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
@if(!empty($placeholder))
  placeholder="{{ $placeholder }}"
@endif
@if(isset($controlAttributes) and is_iterable($controlAttributes))
  @foreach($controlAttributes as $attributeName => $attributeValue)
    @include('kontour::partials.attribute')
  @endforeach
@endif