<section>
  <header>
    Laravel configuration
  </header>
  <dl class="columns-narrow">
    @foreach(['app.name', 'app.url', 'app.env', 'app.debug', 'mail.from.address', 'mail.from.name', 'kontour.guard', 'session.cookie', 'session.lifetime', 'database.default', 'cache.default', 'filesystems.default'] as $configKey)
    <dt><code>{{ $configKey }}</code></dt>
    <dd>{{ config($configKey) }}</dd>
    @endforeach
  </dl>
</section>