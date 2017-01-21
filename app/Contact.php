<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact_phone[] $phones
 * @mixin \Eloquent
 */
class Contact extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }
    public function phones()
    {
        return $this->hasMany('App\Contact_phone');
    }
    public function phone($id)
    {
        $phone = Contact_phone::where('contact_id' , '=', $id)->first();
        return $phone;
    }
}
