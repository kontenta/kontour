<?php

namespace Erik\AdminManagerImplementation\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;

abstract class IntegrationTest extends TestCase
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
            \Erik\AdminManagerImplementation\AdminManagerServiceProvider::class,
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
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Set up database for testing.
     */
    protected function prepareDatabase()
    {
        // Run Laravel's default migrations for user table etc
        $this->loadLaravelMigrations('testbench');

        // Run any migrations registered in service providers
        $this->loadRegisteredMigrations();

        $this->withFactories(__DIR__.'/../database/factories');
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
}
