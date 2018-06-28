<?php

namespace Kontenta\KontourImplementation\Tests;

use Kontenta\KontourImplementation\Tests\Feature\Fakes\User;
use Orchestra\Testbench\Dusk\TestCase;

abstract class DuskTest extends TestCase
{
    use IntegrationTestSetupTrait {
        getEnvironmentSetUp as traitGetEnvironmentSetup;
    }

    /**
     * @var User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->traitGetEnvironmentSetup($app);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('session.driver', 'file');
    }
}
