<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session_type extends Model{

    public function sessions(){
        return $this->hasMany('App\Session');
    }

}
