<section data-kontour-widget="userAccount">
  <span>{{ $user->getDisplayName() }}</span>
  <form action="{{ route('kontour.logout') }}" method="post">
    {{ csrf_field() }}
    <button type="submit">Logout</button>
  </form>
</section>
