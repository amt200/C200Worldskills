<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model{

    public function session_type(){
        return $this->belongsTo('App\Session_type');
    }
    public function room(){
        return $this->belongsTo('App\Room');
    }
    public function channel(){
        return $this->belongsTo('App\Channel');
    }
}
