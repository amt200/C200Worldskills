<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    public function sessions(){
        $this->hasMany('App\Session');
    }
    public function rooms(){
        $this->hasMany('App\Room');
    }
}
