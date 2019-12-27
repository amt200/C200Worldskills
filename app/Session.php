<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model{

    public function session_types(){
        return $this->belongsTo('App\Session_type');
    }
    public function rooms(){
        return $this->belongsTo('App\Room');
    }
}
