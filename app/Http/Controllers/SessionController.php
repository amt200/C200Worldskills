<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Session_type;
use App\Session;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
  public function index(){
      $types = [];

      $session_type = Session_type::all();

      foreach ($session_type as $type){
        $value = $type->type;
        $key = $type->id;
        $types[$key] = $value;
      }

      return view('CreateSession', compact('types'));
  }
  public function store(Request $request){


      $validator = Validator::make($request->all(), [
          'title'=>'regex:/^[A-Z][A-Za-z\s]*$/',
          'speaker'=>'regex:/^[A-Z][A-Za-z\s]*$/',
          'room'=>'regex:/^[A-Z][A-Za-z\s]*$/',
          'cost'=>'regex:/^[0-9]+[.][0-9]+$/',
          'start_time'=>'',
          'end_time'=>'required|date_format',
          'description'=>'required',
      ]);

      if ($validator->fails()) {
          return redirect('event/create_session')
              ->withErrors($validator)
              ->withInput();
      }

      $session = new Session;
      $start_time = new DateTime($request->start_time);
      $end_time = new DateTime($request->end_time);
      $session->event_id = 1;
      $session->room_id = 1;
      $session->session_type_id = $request->type;
      $session->title = $request->title;
      $session->speaker = $request->speaker;
      $session->description = $request->description;
      $session->start_time = $start_time;
      $session->end_time = $end_time;

      $session->save();

      return redirect('event.details');
  }

  public function update(){
    return view('UpdateSession');
  }

}
