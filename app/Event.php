<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function tickets(){
  	return $this->hasMany('App\Ticket');
  }

  public function registrations(){
  	return $this->hasMany('App\Register');
  }

  public function sessions(){
  	return $this->hasMany('App\Session');
  }
}
