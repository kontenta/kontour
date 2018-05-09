<?php

namespace Erik\AdminManagerImplementation\Concerns;

use Erik\AdminManagerImplementation\Notifications\ResetPassword as AdminResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

trait CanResetPassword
{
    use Notifiable;

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
