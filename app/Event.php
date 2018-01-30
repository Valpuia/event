<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $events = [
    	'created' => Events\NewEvent::class
    ];

    public function User(){
    	return $this->belongsTo('App\User');
    }

    public function Location(){
        return $this->hasOne('App\Location');
    }

    public function Feedback(){
    	return $this->hasMany('App\Feedback');
    }
}
