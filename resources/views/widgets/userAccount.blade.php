<section data-kontour-widget="userAccount">
  @if($user instanceof \Kontenta\Kontour\Contracts\AdminUser)<span>{{ $user->getDisplayName() }}</span>@endif
  <form action="{{ route('kontour.logout') }}" method="post">
    {{ csrf_field() }}
    <button type="submit">Logout</button>
  </form>
</section>
