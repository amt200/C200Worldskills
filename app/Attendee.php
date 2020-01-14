<?php


namespace App;


class Attendee extends Model
{
protected $table = 'attendees';

public function registrations(){
    return $this->hasMany('App\Register');
}
public function events(){
    return $this->hasMany('App\Event');
}
}
