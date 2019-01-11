<section>
  <header>
    Laravel configuration
  </header>
  <dl>
    @foreach(['app.name', 'app.url', 'app.env', 'app.debug', 'database.default', 'cache.default', 'filesystems.default', 'mail.from.address', 'mail.from.name', 'session.lifetime', 'session.cookie'] as $configKey)
    <dt><code>{{ $configKey }}</code></dt>
    <dd>{{ config($configKey) }}</dd>
    @endforeach
  </dl>
</section>