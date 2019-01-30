<section>
  <header>
    Laravel configuration
  </header>
  <dl class="columns-narrow">
    @foreach(['app.name', 'app.url', 'app.env', 'app.debug', 'mail.from.address', 'mail.from.name', 'auth.defaults.guard', 'kontour.guard', 'session.cookie', 'session.lifetime', 'database.default', 'cache.default', 'filesystems.default'] as $configKey)
      <div>
        <dt><code>{{ $configKey }}</code></dt>
        <dd>{{ config($configKey) }}</dd>
      </div>
    @endforeach
  </dl>
</section>