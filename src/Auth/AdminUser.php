<?php

namespace Kontenta\Kontour\Auth;

use Illuminate\Notifications\Notifiable;
use Kontenta\Kontour\Auth\Passwords\CanResetPassword;
use Kontenta\Kontour\Contracts\AdminUser as AdminUserContract;

class AdminUser extends \Illuminate\Foundation\Auth\User implements AdminUserContract
{
    use Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getDisplayName(): string
    {
        return $this->getEmailForPasswordReset();
    }
}
