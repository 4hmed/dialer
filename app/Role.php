<?php namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * App\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $perms
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
}