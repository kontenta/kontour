@if(isset($buttonAttributes) and is_iterable($buttonAttributes))
  @foreach($buttonAttributes as $attributeName => $attributeValue)
    @include('kontour::partials.attribute')
  @endforeach
@endif