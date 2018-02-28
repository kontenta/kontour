<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Notifications\ResetPassword;
use Erik\AdminManagerImplementation\Tests\IntegrationTest;
use Erik\AdminManagerImplementation\Tests\Feature\Fakes\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

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

    public function test_password_reset()
    {
        /**
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);

        Notification::fake();

        $response = $this->post(route('admin.password.email'), ['email' => $this->user->getEmailForPasswordReset()]);

        $response->assertRedirect();
        $response->assertSessionHas('status');
        $response->assertSessionMissing('errors');
        Notification::assertSentTo(
            $this->user,
            ResetPassword::class,
            function ($notification) use (&$token) {
                $token = $notification->token;
                return true;
            }
        );

        $response = $this->get(route('admin.password.reset', $token));

        $response->assertSuccessful();

        $new_password = 'NewPassword';
        $response = $this->post(route('admin.password.request'), [
            'token' => $token,
            'email' => $this->user->getEmailForPasswordReset(),
            'password' => $new_password,
            'password_confirmation' => $new_password,
        ]);

        $response->assertRedirect($routeManager->indexUrl());
        $response->assertSessionHas('status');
        $response->assertSessionMissing('errors');
        $this->assertCredentials(['email' => $this->user->getEmailForPasswordReset(), 'password' => $new_password]);
        $this->assertAuthenticatedAs($this->user);
    }

}
