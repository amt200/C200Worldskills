<?php

namespace App\Http\Controllers;

use App\Event;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Session_type;
use App\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Room;
use App\Channel;

class SessionController extends Controller{

  public function index($slug){

      $eventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();


      $formatted_slug = $this->formatSlug($eventBySlug);

      $event_id = $eventBySlug[0]->id;

      $room_names = $this->findRoomByEventId($event_id);

      $types = $this->getAllSessionTypes();

      $channels = $this->getAllChannels();


      return view('CreateSession', compact(['types','room_names','channels','formatted_slug','event_id']));
  }
  private function formatSlug($slug){
      $splited_slug = explode("-", $slug[0]->event_slug);
      $formatted_slug = "";

      for ($i = 0; $i < count($splited_slug); $i++){
          $first_char = strtoupper(substr($splited_slug[$i], 0, 1));
          $remaining_char = substr($splited_slug[$i], 1);
          $formatted_slug .= $first_char.$remaining_char." ";
      }
      return $formatted_slug;
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

private function findRoomByEventId($event_id){
      $room = DB::table('rooms')->where('event_id','=',$event_id)->get();
      $rooms = [];

    foreach ($room as $r){
        $value = $r->room_name;
        $key = $r->id;
        $rooms[$key] = $value;
    }
    return $rooms;
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

      $isValid = $this->isValidSession($request->channel_id, $request->room_id, $request->start_time);

      if ($isValid) {
          $session = new Session;
          $start_time = new DateTime($request->start_time);
          $end_time = new DateTime($request->end_time);
          $session->event_id = $request->event_id;
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

          return redirect('event');
      }
      else{
          return redirect('event/create_session')->with('alertmessage', "A session has already been booked. Please try different time.");
      }
  }




  private function isValidSession($channel_id, $room_id, $start_time){
      $from = new DateTimeZone('GMT');
      $checkSession = "";
      $isValid = false;
      $currentTime     = new DateTime('now', $from);
      $to   = new DateTimeZone('Asia/Singapore');
      $currentTime->setTimezone($to);

      if (Session::where([['channel_id','=',$channel_id],['room_id','=',$room_id]])->get()->last() != null){
          $checkSession = Session::where([['channel_id','=',$channel_id],['room_id','=',$room_id]])->get()->last();
          $endTime = $checkSession->end_time;
          $requestedHour = (int)substr($start_time, 11,2);
          $requestedMonth = (int)substr($start_time, 6,1);
          $requestedDay = (int)substr($start_time, 8, 2);
          $storedHour = (int)substr($endTime, 11,2);
          $storedMonth = (int)substr($endTime, 6, 1);
          $storedDay = (int)substr($endTime, 8,2);

          $isOnSameDay = $requestedMonth == $storedMonth && $requestedDay == $storedDay;

          if ($isOnSameDay && $requestedHour >= $storedHour || $isOnSameDay == false){
              $isValid = true;
          }
          else{
              $isValid = false;
          }
      }
      else{
          $isValid = true;
      }
      return $isValid;
  }

  public function update($slug, $id){
      $sessionData = [];

      $eventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
      $event_id = $eventBySlug[0]->id;

      $sessionById = Session::find($id);
      $id = $sessionById->id;
      $channelData = $this->getAllChannels();
      $sessionTypeData = $this->getAllSessionTypes();


     $formatted_slug = $this->formatSlug($eventBySlug);
      //dd($formatted_slug);
      $roomData = $this->findRoomByEventId($event_id);
      $channelId = $sessionById->channel->id;
      $roomId = $sessionById->room->id;
      $sessionTypeId = $sessionById->session_type->id;


      $sessionData['title'] = $sessionById->title;
      $sessionData['speaker'] = $sessionById->speaker;
      $sessionData['description'] = $sessionById->description;
      $sessionData['cost'] = $sessionById->cost;
      $sessionData['start_time'] = $sessionById->start_time;
      $sessionData['end_time'] = $sessionById->end_time;


      return view('UpdateSession', compact(['slug','sessionData','roomData','roomId','channelId','channelData','sessionTypeId','sessionTypeData','id','formatted_slug','event_id']));
  }
  public function storeUpdate(Request $request, $slug){


      $validator = Validator::make($request->all(), [
          'title'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'speaker'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
          'cost'=>'required|regex:/^[0-9]+[.]{0,1}[0-9]+$/',
          'start_time'=>'required',
          'end_time'=>'required',
          'description'=>'required',
      ]);


      if ($validator->fails()) {
          return redirect('event/'.$slug.'/update_session/'.$request->id)
              ->withErrors($validator)
              ->withInput();
      }
      $id = $request->id;

      $isValid = $this->isValidSession($request->channel_id, $request->room_id, $request->start_time);

      if($isValid){
          Session::where('id', $id)->update(['title'=>$request->title, 'speaker'=>$request->speaker,
              'room_id'=>$request->room_id, 'channel_id'=>$request->channel_id, 'cost'=>$request->cost,
              'start_time'=>$request->start_time, 'end_time'=>$request->end_time]);
          return redirect('event');
      }
     else{
         return redirect('event/'.$slug.'/update_session/'.$request->id)->with('alertmessage', "A session has already been booked. Please try different time.");
     }
  }

  public function delete($id, $slug){
      Session::where('id', $id)->delete();
      return redirect('event');
  }
}
