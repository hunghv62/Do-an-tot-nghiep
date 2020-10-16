<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const MALE = 1;
    const FEMALE = 2;
    const ADMIN = 1;
    const USER = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dateFormat = 'Y-m-d h:m:s.v';

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_day',
        'gender',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        // When reset password by email, the password has already been hashed before coming here
        // So we need to check if the password needs to be hashed or not
        $this->attributes['password'] = \Hash::needsRehash($value) ? bcrypt($value) : $value;
    }
}
