<?php

namespace Kontenta\AdminManagerImplementation\Tests\Feature;

use Kontenta\AdminManagerImplementation\Tests\UserlandAdminToolTest;
use Kontenta\AdminManagerImplementation\Tests\Feature\Fakes\User;

class UserlandControllerTest extends UserlandAdminToolTest
{
    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
    }

    public function test_index_route()
    {
        $response = $this->actingAs($this->user)->get(route('userland.index'));

        $response->assertSee('<main');
    }
}
