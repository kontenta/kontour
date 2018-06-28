<?php

namespace Kontenta\KontourImplementation\Tests\Feature;

use Kontenta\KontourImplementation\Auth\Notifications\ResetPassword;
use Kontenta\KontourImplementation\Tests\IntegrationTest;
use Kontenta\KontourImplementation\Tests\Feature\Fakes\User;
use Illuminate\Support\Facades\Notification;

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

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Test with Laravel's default password reset config
        $app['config']->set('admin.passwords', 'users');
        parent::getEnvironmentSetUp($app);
    }

    public function test_request_password_reset_url()
    {
        $response = $this->get(route('admin.password.request'));

        $response->assertSuccessful();
    }

    public function test_password_reset()
    {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);

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
