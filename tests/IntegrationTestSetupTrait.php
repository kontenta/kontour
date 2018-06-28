<?php

namespace Kontenta\AdminManagerImplementation\Tests;

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Kontenta\AdminManagerImplementation\Tests\Feature\Fakes\User;

trait IntegrationTestSetupTrait
{

    /**
     * Get the service providers for the package.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Kontenta\AdminManagerImplementation\Providers\AdminManagerServiceProvider::class,
        ];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('auth.providers.users.model', User::class);
    }

    /**
     * Set up database for testing.
     */
    protected function prepareDatabase()
    {
        // Make sure sqlite database file exists
        if ($this->app->config->get('database.default') === 'sqlite') {
            touch($this->app->config->get('database.connections.sqlite.database'));
        }

        // Run Laravel's default migrations for user table etc
        $this->loadLaravelMigrations($this->app->config->get('database.default'));

        // Run any migrations registered in service providers
        $this->loadRegisteredMigrations();

        $this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * Run migrations registered in service providers.
     *
     * @return void
     */
    protected function loadRegisteredMigrations(): void
    {
        $this->artisan('migrate');

        $this->app[ConsoleKernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }

    /**
     * Make sure all integration tests use the Laravel files of the testbench-dusk package.
     *
     * This avoids duplicate classes in migrations.
     * Overrides \Orchestra\Testbench\Dusk\TestCase::getBasePath and
     * \Orchestra\Testbench\Concerns\CreatesApplication::getBasePath
     *
     * @return string
     */
    protected function getBasePath()
    {
        return __DIR__.'/../vendor/orchestra/testbench-dusk/laravel';
    }
}
