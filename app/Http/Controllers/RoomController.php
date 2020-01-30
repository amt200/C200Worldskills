<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Channel;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
  public function index()
  {
    return view('RoomCapacity');
  }

  public function create(){
      $channel_names = [];

      $channel_records = Channel::all();

      foreach ($channel_records as $channel){
          $value = $channel->channel_name;
          $key = $channel->id;
          $channel_names[$key] = $value;
      }

      return view('CreateRoom', compact('channel_names'));
  }
  public function store(Request $request){
      $validator = Validator::make($request->all(), [
          'room_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/'
      ]);

      if ($validator->fails()) {
          return redirect('event/create_room')
              ->withErrors($validator)
              ->withInput();
      }
      $room = new room;

      $room->room_name = $request->room_name;
      $room->channel_id = $request->channel;
      $room->room_capacity = $request->room_capacity;

      $room->save();
      return redirect('event/details');
  }
}
