<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\ShowAdminVisit;
use Kontenta\Kontour\Tests\Feature\Fakes\User;
use Kontenta\Kontour\Tests\UserlandAdminToolTest;

class AdminVisitTest extends UserlandAdminToolTest
{
    /**
     * @var User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
    }

    public function test_can_be_serialized_and_deserialized()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');
        $visit = new ShowAdminVisit($link, $this->user);

        $serializedVisit = serialize($visit);
        $visit->__wakeup(); // Restore any serialized models on the original object
        $unserializedVisit = unserialize($serializedVisit);

        $this->assertEquals($visit, $unserializedVisit, "Unserialization did not produce the original object structure");
    }
}
