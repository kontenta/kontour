@if(is_int($attributeName))
  {{ $attributeValue }}
@elseif(is_bool($attributeValue))
  @if($attributeValue)
    {{ $attributeName }}
  @endif
@else
  {{ $attributeName }}="{{ $attributeValue }}"
@endif