<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\URL;
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
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createRules($id)
    {

        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$id}"],
            'role_id' => ['required', 'integer', "exists:users_roles,id"],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ];
    }

    public static function insertRules($id)
    {

        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$id}"],
            'role_id' => ['required', 'integer', "exists:users_roles,id"],
        ];
    }

    public static function passwordRules()
    {

        return [
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ];
    }

    public static function attributesForRules()
    {
        return [

            'role_id' => 'Права пользователя'

        ];
    }
}
