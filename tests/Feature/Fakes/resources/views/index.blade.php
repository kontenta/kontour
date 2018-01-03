@inject('view_manager', 'Erik\AdminManager\Contracts\ViewManager')

@extends($view_manager->getLayout())

@section('main')
  <ul>
    <li>Item 1</li>
    <li>Item 2</li>
  </ul>
@append
