@if(isset($groupAttributes) and is_iterable($groupAttributes))
  @foreach($groupAttributes as $attributeName => $attributeValue)
    @include('kontour::forms.partials.attribute')
  @endforeach
@endif