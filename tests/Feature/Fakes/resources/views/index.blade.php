@inject('view_manager', 'Kontenta\AdminManager\Contracts\AdminViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
@append
