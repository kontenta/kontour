@include('kontour::forms.partials.nameAttribute')

<?php
  $controlAttributes['id'] = $controlId;
  unset($controlAttributes['name']);
  if($errors->hasAny($errorsKeys ?? $name)) {
    $controlAttributes['aria-invalid'] = "true";
    $controlAttributes['aria-describedby'] = array_merge([$errorsId], [$controlAttributes['aria-describedby'] ?? []]);
  }
  if(!empty($autofocusControlId) and $autofocusControlId == $controlId) {
    $controlAttributes[] = 'autofocus';
  }
  if(!empty($placeholder)) {
    $controlAttributes['placeholder'] = $placeholder;
  }
?>
@foreach($controlAttributes as $attributeName => $attributeValue)
@include('kontour::partials.attribute')
@endforeach