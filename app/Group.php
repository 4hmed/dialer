<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Group
 *
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @mixin \Eloquent
 */
class Group extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function contacts() {
        return $this->belongsToMany('App\Contact');
    }

}
