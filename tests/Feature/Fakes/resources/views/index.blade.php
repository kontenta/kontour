@inject('view_manager', 'Erik\AdminManager\Contracts\ViewManager')

@extends($view_manager->layout())

@section($view_manager->mainSection())
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
@append
