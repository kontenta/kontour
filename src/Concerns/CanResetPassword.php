<?php

namespace Erik\AdminManagerImplementation\Concerns;

use Erik\AdminManagerImplementation\Notifications\ResetPassword as AdminResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use \Illuminate\Auth\Passwords\CanResetPassword as BaseCanResetPassword;

trait CanResetPassword
{
    use BaseCanResetPassword, Notifiable;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
