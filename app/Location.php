<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    public function Event(){
    	return $this->belongsTo('App\Event','loc_id');
    }
}
