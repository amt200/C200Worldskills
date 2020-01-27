<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special_validity_type extends Model
{
    public function validity(){
    	return $this->hasMany('App\Ticket');
    }
}
