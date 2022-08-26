<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
     public function users(){
        return $this->hasMany('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }
}
