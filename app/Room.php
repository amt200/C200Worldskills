<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    public function sessions(){
        return $this->hasMany('App\Session');
    }
}
