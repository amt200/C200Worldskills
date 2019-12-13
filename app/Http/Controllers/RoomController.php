<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
  public function Index()
  {
    return view('RoomCapacity');
  }

  public function Create()
  {
    return view('CreateRoom');
  }
}
