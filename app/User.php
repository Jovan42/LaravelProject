<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        return $this->hasOne(EmailVerification::class);
    }
    public function passReset()
    {
        return $this->hasOne(PasswordReset::class);
    }
    public function settings()
    {
        return $this->hasOne(Settings::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
