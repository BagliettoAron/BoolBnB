<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function accomodations(){
        return $this->belongsTo('App\Accomodation');
    }
}
