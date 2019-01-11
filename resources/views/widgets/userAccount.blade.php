<section data-kontour-widget="userAccount">
  <small>
    @if($user instanceof \Kontenta\Kontour\Contracts\AdminUser)<span>{{ $user->getDisplayName() }}</span>@endif
    <form action="{{ route('kontour.logout') }}" method="post">
      @csrf
      <button type="submit">Logout</button>
    </form>
  </small>
</section>
