@if($errors->hasAny($errorsKeys = $errorsKeys ?? $name))
  <ul id="{{ $errorsId }}">
    @foreach(\Illuminate\Support\Arr::wrap($errorsKeys) as $key)
      @foreach(\Illuminate\Support\Arr::flatten($errors->get($key)) as $message)
        <li>{{ $message }}</li>
      @endforeach
    @endforeach
  </ul>
@endif