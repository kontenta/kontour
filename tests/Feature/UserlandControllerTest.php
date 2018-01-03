<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Tests\UserlandAdminToolTest;

class UserlandControllerTest extends UserlandAdminToolTest
{
    public function test_index_route()
    {
        $response = $this->get(route('userland.index'));

        $response->assertSee('<main');
    }
}
