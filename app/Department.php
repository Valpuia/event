<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public function User(){
    	return $this->belongsTo('App\User');
    }
}
