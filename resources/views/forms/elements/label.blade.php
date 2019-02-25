<{{ $labelTag = $labelTag ?? 'label' }}
@if(isset($controlId))
  for="{{ $controlId }}"
@endif
@if(isset($labelAttributes) and is_iterable($labelAttributes))
  @foreach($labelAttributes as $attributeName => $attributeValue)
    @include('kontour::partials.attribute')
  @endforeach
@endif
>{{ $labelStart ?? '' }}{{ $label ?? ucfirst(Lang::has('validation.attributes.'.$name) ? Lang::trans('validation.attributes.' . $name) : str_replace(['_', '.', '[]'], [' ', ' ', ''], $name)) }}{{ $labelEnd ?? '' }}</{{ $labelTag }}>