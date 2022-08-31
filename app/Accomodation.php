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

    public function sponsors() {
        return $this->belongsToMany('App\Sponsor');
    }

    protected $fillable = [
        'user_id',
        'title',
        'picture',
        'number_of_rooms',
        'number_of_beds',
        'number_of_bathrooms',
        'square_meters',
        'price_per_night',
        'visible',
        'address',
        'lat',
        'lon'
    ];
}
