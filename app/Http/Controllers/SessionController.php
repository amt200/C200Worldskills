<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session_type;

class SessionController extends Controller
{
  public function index(){
      $types = [];
      $session_type = Session_type::all();
      foreach ($session_type as $type){
        $value = $type->type;
        $types[$value] = $value;
      }
      return view('CreateSession', compact('types'));
  }
  public function store(Request $request){
      $this->validate($request, [
          'type'=>'required',
          'title'=>'required',
          'speaker'=>'required',
          'room'=>'required',
          'cost'=>'required',
          'start_time'=>'required',
          'end_time'=>'required',
          'description'=>'required',
      ]);
      return redirect('event.create_session');
  }

  public function update(){
    return view('UpdateSession');
  }

}
