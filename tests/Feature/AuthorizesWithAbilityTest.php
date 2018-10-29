<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Tests\IntegrationTest;
use Kontenta\Kontour\Tests\Feature\Fakes\User;

class AuthorizesWithAbilityTest extends IntegrationTest
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

    public function test_can_be_serialized_and_deserialized() {
        $link = AdminLink::create('Reset password', 'http://test.com');

        $serializedLink = serialize($link);
        $unserializedLink = unserialize($serializedLink);

        $this->assertEquals($link, $unserializedLink, "Unserialization did not produce the orginal object structure");
    }
}
