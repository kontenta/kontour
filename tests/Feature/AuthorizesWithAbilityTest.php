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

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();

        Gate::define('testGate', function ($user, $argument) {
            return $user->id == $argument->id;
        });
    }

    public function test_authorizing_with_gate()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');
        $link->registerAbilityForAuthorization('testGate', $this->user);

        $this->assertTrue($link->isAuthorized($this->user));
    }

    public function test_authorized_without_ability()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');

        $this->assertTrue($link->isAuthorized());
    }

    public function test_not_authorized_without_user()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');
        $link->registerAbilityForAuthorization('testGate', $this->user);

        $this->assertFalse($link->isAuthorized());
    }

    public function test_not_authorized_with_non_existing_guard()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');
        $link->registerAbilityForAuthorization('testGate', $this->user);
        $link->registerGuardForAuthorization('non.existing.guard');

        $this->assertFalse($link->isAuthorized($this->user));
    }

    public function test_can_be_serialized_and_deserialized()
    {
        $link = AdminLink::create('Reset password', 'http://test.com');
        $link->registerAbilityForAuthorization('testGate', $this->user);

        $serializedLink = serialize($link);
        $link->__wakeup(); // Restore any serialized models on the original object
        $unserializedLink = unserialize($serializedLink);

        $this->assertTrue($unserializedLink->isAuthorized($this->user));
        $this->assertEquals($link, $unserializedLink, "Unserialization did not produce the original object structure");
    }
}
