<?php

namespace Erik\AdminManagerImplementation\Tests;

use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\Dusk\TestCase;

abstract class DuskTest extends TestCase
{
    use IntegrationTestSetup;

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
}
