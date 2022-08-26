<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function accomodations() {
        return $this->belongsToMany('App\Accomodation');
    }
}
