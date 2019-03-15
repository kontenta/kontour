@if(is_int($attributeName))
  {{ $attributeValue }}
@elseif(is_bool($attributeValue))
  @if($attributeValue)
    {{ $attributeName }}
  @endif
@elseif(is_array($attributeValue))
  {{ $attributeName }}="{{ implode(' ', \Illuminate\Support\Arr::flatten($attributeValue)) }}"
@else
  {{ $attributeName }}="{{ $attributeValue }}"
@endif