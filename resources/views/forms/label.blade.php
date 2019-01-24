<{{ $labelTag = $labelTag ?? 'label' }}
@if(isset($controlId))
  for="{{ $controlId }}"
@endif
@if(isset($labelAttributes))
  @if(is_iterable($labelAttributes))
    @foreach($labelAttributes as $attributeName => $attributeValue)
      @include('kontour::forms.partials.attribute')
    @endforeach
  @else
    {!! $labelAttributes !!}
  @endif
@endif
>{!! $labelStart ?? '' !!}{!! $label ?? ucfirst(Lang::has('validation.attributes.'.$name) ? Lang::trans('validation.attributes.'.$name) : str_replace('_', ' ', $name)) !!}{!! $labelEnd ?? '' !!}</{{ $labelTag }}>