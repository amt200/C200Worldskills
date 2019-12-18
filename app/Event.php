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

  public function channels(){
  	return $this->hasMany('App\Channel');
  }

  public function sessions(){
  	return $this->hasOne('App\Organization');
  }
}
