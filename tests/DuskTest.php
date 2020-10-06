<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Feature\Fakes\User;
use Orchestra\Testbench\Dusk\TestCase;
use Illuminate\Support\Facades\Cache;

abstract class DuskTest extends TestCase
{
    use IntegrationTestSetupTrait {
        getEnvironmentSetUp as traitGetEnvironmentSetup;
    }

    protected static $baseServePort = 8001;

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
        Cache::flush();
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
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('session.driver', 'file');

        copy(__DIR__ . '/../resources/css/kontour.css', public_path('kontour.css'));
        $app['config']->set('kontour.stylesheets', ['kontour.css']);

        copy(__DIR__ . '/../resources/js/kontour.js', public_path('kontour.js'));
        $app['config']->set('kontour.javascripts', ['kontour.js']);
    }
}
