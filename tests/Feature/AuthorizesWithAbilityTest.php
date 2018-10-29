<?php

namespace Kontenta\Kontour\Tests\Feature;

use Illuminate\Support\Facades\Gate;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Tests\Feature\Fakes\User;
use Kontenta\Kontour\Tests\IntegrationTest;

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

        Gate::define('testGate', function ($user) {
            return true;
        });
    }

    public function test_authorizing_with_gate()
    {
        $link = AdminLink::create('Reset password', 'http://test.com')->registerAbilityForAuthorization('testGate');

        $this->assertTrue($link->isAuthorized($this->user));
    }

    public function test_not_authorized_without_user()
    {
        $link = AdminLink::create('Reset password', 'http://test.com')->registerAbilityForAuthorization('testGate');

        $this->assertFalse($link->isAuthorized());
    }

    public function test_can_be_serialized_and_deserialized()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');

        $serializedLink = serialize($link);
        $unserializedLink = unserialize($serializedLink);

        $this->assertEquals($link, $unserializedLink, "Unserialization did not produce the orginal object structure");
    }
}
