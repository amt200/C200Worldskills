<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $table = 'events';
  protected $dates = ['event_date'];
  public $timestamps = false;

  public function tickets(){
  	return $this->hasMany('App\Ticket');
  }

  public function registrations(){
  	return $this->belongsToMany('App\Attendee', 'attendee_register_event');
  }

  public function sessions(){
  	return $this->hasMany('App\Session');
  }
    public function channels(){
        return $this->hasMany('App\Channel');
    }
  public function rooms(){
      return $this->hasMany('App\Room');
  }
}
