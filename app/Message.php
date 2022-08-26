<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'surname', 'message_content', 'accomodation_id'
    ];

    public function accomodation() {
        return $this->belongsTo('App\Accomodation');
    }
}
