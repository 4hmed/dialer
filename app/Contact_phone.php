<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact_phone
 *
 * @property-read \App\Contact $contact
 * @mixin \Eloquent
 */
class Contact_phone extends Model
{
    public function contact() {
        return $this->belongsTo('App\Contact');
    }

}
