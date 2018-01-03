<?php

namespace Erik\AdminManagerImplementation\Tests;

use Orchestra\Testbench\TestCase;

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
}
