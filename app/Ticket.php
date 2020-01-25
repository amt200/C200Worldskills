<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $dates = ['tickets_sell_by_date'];
    public function event(){
        return $this->belongsTo('App\Event');
    }
}
