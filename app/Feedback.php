<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $events = [
    	'created' => Events\NewFeedback::class
    ];

    public function Event(){
        return $this->belongsTo('App\Event');
    }
}
