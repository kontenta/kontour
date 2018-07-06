<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Kontenta\KontourSupport\Tests\UserlandAdminToolTest;
use Kontenta\KontourSupport\Tests\Feature\Fakes\User;

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
