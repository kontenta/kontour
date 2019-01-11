<section data-kontour-widget="userAccount">
  @if($user instanceof \Kontenta\Kontour\Contracts\AdminUser)<small>{{ $user->getDisplayName() }}</small>@endif
  <form action="{{ route('kontour.logout') }}" method="post">
    @csrf
    <small><button type="submit">Logout</button></small>
  </form>
</section>
