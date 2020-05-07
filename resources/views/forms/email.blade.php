@include('kontour::forms.input', ['type' => $type ?? 'email', 'name' => $name ?? 'email',
'controlAttributes' => array_merge(
['autocomplete' => 'email', 'autocapitalize' => 'none', 'autocorrect' => 'off'],
$controlAttributes ?? []
)])