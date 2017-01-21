<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function contacts() {
        return $this->hasMany('App\Contact');
    }

    public function groups() {
        return $this->hasMany('App\Group');
    }
}
