<?php

namespace Kontenta\KontourImplementation\Tests\Feature;

use Kontenta\KontourImplementation\Tests\UserlandAdminToolTest;
use Kontenta\KontourImplementation\Tests\Feature\Fakes\User;

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
