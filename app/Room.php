<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function channels(){
        return $this->hasMany('App\Channel');
    }
    public function sessions(){
        return $this->hasMany('App\Session');
    }
}
