<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
  public function Index()
  {
    return view('ManageEvent');
  }

  public function create()
  {
    return view('CreateEvent');
  }

  public function details()
  {
    return view('EventDetail');
  }
}
