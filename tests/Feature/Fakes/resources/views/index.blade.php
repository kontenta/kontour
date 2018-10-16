@inject('view_manager', 'Kontenta\Kontour\Contracts\AdminViewManager')

@extends($view_manager->toolLayout())

@section($view_manager->toolMainSection())
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
@append

