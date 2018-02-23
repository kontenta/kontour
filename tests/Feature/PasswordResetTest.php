<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Tests\IntegrationTest;
use Erik\AdminManagerImplementation\Tests\Feature\Fakes\User;

class PasswordResetTest extends IntegrationTest
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

    public function test_request_password_reset_url()
    {
        $response = $this->get(route('admin.password.request'));

        $response->assertSuccessful();
    }

    public function test_request_password_email_is_sent() {
        $response = $this->post(route('admin.password.email'),['email' => $this->user->getEmailForPasswordReset()]);

        $response->assertSuccessful();
        //TODO: assert email was sent and contains correct link
    }
}
