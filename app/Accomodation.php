<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
     public function users(){
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }
}
