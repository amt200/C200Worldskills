<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

use App\Event;
use App\Ticket;
use App\Room;
use App\Channel;
use App\Session;

class EventController extends Controller
{
  public function index()
  {    
    $events = Event::all();

    $row_count = "";
    $dataArr = [];

    $data = DB::table('events')->get()->last();
    for($i = $data->id; $i > 0; $i--){
      $row_count = DB::table('attendee_register_event')
      ->select(DB::raw("COUNT(id) as count_row"))
      ->where("event_id", "=", $i)
      ->get();

      $value = $row_count[0]->count_row;
      $key = $i;
      $dataArr[$key] = $value;
    }

    return view('ManageEvent', compact('events','dataArr'));
  }

  public function create(Request $request)
  {
    if($request->isMethod('post') )
    {
      $validator = Validator::make($request -> all(), [
        'event_name' => 'required',
        'event_slug' => 'required',
        'event_date' => 'required'
      ]);

      if($validator->fails())
      {
        return redirect()->route('event.create')->withErrors($validator);
      }
      else
      {
        $event = new Event;
        $event->event_name = $request->event_name;
        $event->event_slug = $request->event_slug;
        $event->organizer_id = $request->organizer;
        $event->event_date = $request->event_date;
        $insert = $event->save();

        if($insert)
        {
          return redirect()->route('event')->with('success', 'Event successfully created');
        }
        else
        {
          return redirect()->route('event')->with('error', 'An error occured while creating event');
        }
      }
    }
    return view('CreateEvent');
  }

  public function overview($slug){
    // Get slug from database
    // $event = \DB::table('events')->where('event_slug', $slug)->first();
    $event = Event::where('event_slug', '=', $slug)->first();

    // Get the ticket data
    $ticket = Ticket::all();

    // Get the ticket data
    $session = Session::all();

    // Get the ticket data
    $room = Room::all();

    // Get the ticket data
    $channel = Channel::all();

    // Count Sessions
    $row_count = "";
    $sessionArr = [];

    $data = DB::table('sessions')->get()->last();
    for($i = $data->id; $i > 0; $i--){
      $row_count = DB::table('channels')
      ->select(DB::raw("COUNT(id) as count_row"))
      ->where("id", "=", $i)
      ->get();

      $value = $row_count[0]->count_row;
      $key = $i;
      $sessionArr[$key] = $value;
    } 

    // Count Rooms
    $room_row_count = "";
    $roomArr = [];

    $data = DB::table('rooms')->get()->last();
    for($i = $data->id; $i > 0; $i--){
      $room_row_count = DB::table('channels')
      ->select(DB::raw("COUNT(id) as count_row"))
      ->where("id", "=", $i)
      ->get();

      $roomvalue = $room_row_count[0]->count_row;
      $key = $i;
      $roomArr[$key] = $roomvalue;
    } 

    dd($roomArr);

    // Count Rooms
    /*$roomArr = DB::table('rooms')
         ->join('channels', 'channels.id', '=', 'rooms.channel_id')
         ->select('rooms.channel_id', DB::raw('COUNT(rooms.channel_id) AS total_rooms'))
         ->groupBy('channel_id')
         ->get(); */

    /*$roomArr = DB::table('rooms')
         ->join('channels', 'channels.id', '=', 'rooms.channel_id')
         ->join('sessions', 'sessions.id', '=', 'channels.channel_id')
         ->select('rooms.channel_id', DB::raw('COUNT(rooms.channel_id) AS total_rooms'))
         // ->select('sessions.channel_id', DB::raw('COUNT(sessions.channel_id) AS total_sessions'))
         ->groupBy('channel_id')
         ->get();

         dd($roomArr);*/

    return view('EventOverview', compact('event', 'ticket', 'session', 'room', 'channel', 'sessionArr', 'roomArr'));
    // return view('EventOverview', compact('event', 'ticket', 'session', 'room', 'channel', 'sessionArr'));
  }
}
