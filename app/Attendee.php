<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Attendee extends Authenticatable
{

	use Notifiable;

  protected $guard = 'attendee';

  protected $fillable = [
    'lastName', 'token',
  ];

  protected $hidden = [
    'token', 'remember_token',
  ];
  public function sessions(){
      return $this->belongsToMany('App\Session','attendee_register_event');
  }
    public function events(){
        return $this->belongsToMany('App\Event', 'attendee_register_event');
    }

}
