<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model{

    protected $dates = ['start_time', 'end_time'];

    public function session_type(){
        return $this->belongsTo('App\Session_type');
    }
    public function room(){
        return $this->belongsTo('App\Room');
    }
    public function channel(){
        return $this->belongsTo('App\Channel');
    }
    public function event(){
        return $this->belongsTo('App\Event');
    }
}
