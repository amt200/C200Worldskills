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

      $types = $this->getAllSessionTypes();

      $channels = $this->getAllChannels();

      $room_names = $this->getAllRooms();

      return view('CreateSession', compact(['types','room_names','channels']));
  }
  private function getAllSessionTypes(){
      $types = [];

      $session_type = Session_type::all();

      foreach ($session_type as $type){
          $value = $type->type;
          $key = $type->id;
          $types[$key] = $value;
      }
      return $types;
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
      $checkSession = "";
      $alertmessage = "";
      $isValid = false;
      $currentTime     = new DateTime('now', $from);
      $to   = new DateTimeZone('Asia/Singapore');
      $currentTime->setTimezone($to);

      $validator = Validator::make($request->all(), [
          'title'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'speaker'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'cost'=>'required|regex:/^[0-9]+[.]{0,1}[0-9]+$/',
          'start_time'=>'required',
          'end_time'=>'required',
          'description'=>'required',
      ]);

      if ($validator->fails()) {
          return redirect('event/create_session')
              ->withErrors($validator)
              ->withInput();
      }

      if (Session::where([['channel_id','=',$request->channel_id],['room_id','=',$request->room_id]])->get()->last() != null){
          $checkSession = Session::where([['channel_id','=',$request->channel_id],['room_id','=',$request->room_id]])->get()->last();
          $endTime = $checkSession->end_time;
          $requestedHour = (int)substr($request->start_time, 11,13);
          $storedHour = (int)substr($endTime, 11,13);

          if ($requestedHour >= $storedHour){
              $isValid = true;
          }
          else{
              $isValid = false;
              $alertmessage = "A session has already been booked. Please try different time.";
              return redirect(route('event.create_session', compact('alertmessage')));
          }
      }
      else{
          $isValid = true;
      }

      if ($isValid) {
          $session = new Session;
          $start_time = new DateTime($request->start_time);
          $end_time = new DateTime($request->end_time);
          $session->event_id = 1;
          $session->room_id = $request->room_id;
          $session->channel_id = $request->channel_id;
          $session->session_type_id = $request->type;
          $session->title = $request->title;
          $session->speaker = $request->speaker;
          $session->description = $request->description;
          $session->cost = $request->cost;
          $session->start_time = $start_time;
          $session->end_time = $end_time;

          $session->save();

          return redirect('event/details');
      }
  }

  public function update($id){
      $sessionData = [];

      $sessionById = Session::find($id);
      $id = $sessionById->id;
      $channelData = $this->getAllChannels();
      $roomData = $this->getAllRooms();
      $sessionTypeData = $this->getAllSessionTypes();

      $channelId = $sessionById->channel->id;
      $roomId = $sessionById->room->id;
      $sessionTypeId = $sessionById->session_type->id;


      $sessionData['title'] = $sessionById->title;
      $sessionData['speaker'] = $sessionById->speaker;
      $sessionData['description'] = $sessionById->description;
      $sessionData['cost'] = $sessionById->cost;
      $sessionData['start_time'] = $sessionById->start_time;
      $sessionData['end_time'] = $sessionById->end_time;


      return view('UpdateSession',compact(['sessionData','roomId','channelId','roomData','channelData','sessionTypeId','sessionTypeData','id']));
  }
  public function storeUpdate(Request $request){


      $validator = Validator::make($request->all(), [
          'title'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'speaker'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'cost'=>'required|regex:/^[0-9]+[.]{0,1}[0-9]+$/',
          'start_time'=>'required',
          'end_time'=>'required',
          'description'=>'required',
      ]);

      if ($validator->fails()) {
          return redirect('event/create_session')
              ->withErrors($validator)
              ->withInput();
      }
      $id = $request->id;

      Session::where('id', $id)->update(['title'=>$request->title, 'speaker'=>$request->speaker,
          'room_id'=>$request->room_id, 'channel_id'=>$request->channel_id, 'cost'=>$request->cost,
          'start_time'=>$request->start_time, 'end_time'=>$request->end_time]);
      return redirect('event/details');
  }

  public function delete($id){
      Session::where('id', $id)->delete();
      return redirect('event/details');
  }
}
