<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Session_type;
use App\Session;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use App\Room;
use App\Channel;

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

      $channels = $this->getAllChannels();

      $room_names = $this->getAllRooms();

      return view('CreateSession', compact(['types','room_names','channels']));
  }

  private function getAllRooms(){
      $room_names = [];

      $room_records = Room::all();

      foreach ($room_records as $room){
          $value = $room->room_name;
          $key = $room->id;
          $room_names[$key] = $value;
      }
      return $room_names;
  }


  private function getAllChannels(){
      $channels = [];

      $channel_records = Channel::all();
      foreach ($channel_records as $channel){
          $value = $channel->channel_name;
          $key = $channel->id;
          $channels[$key] = $value;
      }
      return $channels;
  }

  public function store(Request $request){

      $from = new DateTimeZone('GMT');
      $previousEndTime     = new DateTime('now', $from);
      $to   = new DateTimeZone('Asia/Singapore');
      $previousEndTime->setTimezone($to);

      if (Session::all()->last() != null){
          $previousEndTime = Session::all()->last()->end_time;
      }

      $validator = Validator::make($request->all(), [
          'title'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'speaker'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'cost'=>'required|regex:/^[0-9]+[.]{0,1}[0-9]+$/',
          'start_time'=>'required|date_format:m-d-Y H:i|after_or_equal:'.$previousEndTime,
          'end_time'=>'required|regex:/^[0-9]{4}[-][0-1][0-9][-][0-3][0-9][ ][0-2][0-9][:][0-5][0-9]$/',
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

      return redirect('event/details');
  }

  public function update($id){
      $sessionData = [];

      $sessionById = Session::find($id);
      $channelData = $this->getAllChannels();
      $roomData = $this->getAllRooms();

      $channelId = $sessionById->channel->id;
      $roomId = $sessionById->room->id;


      $sessionData['title'] = $sessionById->title;
      $sessionData['speaker'] = $sessionById->speaker;
      $sessionData['description'] = $sessionById->description;
      $sessionData['cost'] = $sessionById->cost;
      $sessionData['start_time'] = $sessionById->start_time;
      $sessionData['end_time'] = $sessionById->end_time;


      return view('UpdateSession',compact(['sessionData','roomId','channelId','roomData','channelData']));
  }
  public function storeUpdate($request){

  }

}
