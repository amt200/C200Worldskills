<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;

use App\Event;
use App\Ticket;
use App\Room;
use App\Channel;
use App\Session;

class EventController extends Controller
{
  public function index()
  {
    $events = DB::table('events')->get();
    // $data = \DB::table('events')->get();

    $dataCount = DB::table('events')->count();

    /*$data = DB::table('register')
          ->join('events', 'events.id', '=', 'register.event_id')
          ->select('events.event_name')
          ->where('events.id', '=', 'register.event_id')
          ->get();*/
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
    //dd($dataArr);

          // ->join('attendee_register_event', 'attendee_register_event.event_id', '=', 'events.id')
          // ->where('register.event_id', '=', 'events.id')
          // ->get();
          // ->where('register.event_id', '=', 'events.id')
          // ->get();

    /*$e = array();
    $i = 1;
    foreach($data as $d){
      $ev = DB::table('events')
          ->join('register', 'register.event_id', '=', 'event.id')
          // ->where('register.event_id', '=', 'events.id')
          ->get();
          // ->where('register.event_id', '=', 'events.id')
          // ->get();
      $e[] = $ev;
    }*/
    // $data = DB::table('register')
    //       ->where('register.event_id', '=', $event_id)
    //       ->count();
          // ->where('register.event_id', '=', 'events.id')
          // ->get();


    // dd($events,$data);


    return view('ManageEvent', compact(['events','dataArr']));
    // return view('ManageEvent')->with(['events' => $events]);
    // return view('ManageEvent')->with(['events' => $events]->with(['event_registrations' => $event_registrations]));
    // return view('ManageEvent')->with('events', ['events' => $events, 'event_registrations' => $event_registrations]);
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

    /*// Count Sessions
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
      $room_row_count = DB::table('channels')
      ->select(DB::raw("COUNT(id) as count_row"))
      ->where("id", "=", $i)
      ->get();

      $roomvalue = $room_row_count[0]->count_row;
      $key = $i;
      $roomArr[$key] = $roomvalue;
    } 

    dd($roomArr);*/

    // Count Rooms
    // $row_count = "";
    // $roomArr = [];

    // Works for room 26/1/2019
    $data = DB::table('rooms')
      ->select('channel_id', DB::raw('COUNT(rooms.channel_id) AS total_rooms'))
      ->groupBy('channel_id')
      ->get(); 

    // $data = DB::table('sessions')
    //   ->join('rooms', 'sessions.channel_id', '=', 'rooms.channel_id')
    //   ->select('sessions.channel_id', 'rooms.channel_id', DB::raw('COUNT(sessions.channel_id) AS total_sessions, COUNT(rooms.channel_id) AS total_rooms'))
    //   ->groupBy('sessions.channel_id', 'rooms.channel_id')
    //   ->get(); 
    //   
    /*$data = DB::table("channels")
    ->join('rooms', 'channels.id', '=', 'rooms.channel_id')
    ->join('sessions', 'rooms.id', '=', 'sessions.room_id')
    ->select('channels.channel_name', DB::raw('COUNT(sessions.id) AS total_sessions, COUNT(rooms.id) AS total_rooms'))
    ->groupBy('channels.channel_name')
    ->get();*/


   
        // dd($data);

      /*$roomArr = DB::table('rooms')
           ->join('channels', 'channels.id', '=', 'rooms.channel_id')
           ->join('sessions', 'sessions.id', '=', 'channels.channel_id')
           ->select('rooms.channel_id', DB::raw('COUNT(rooms.channel_id) AS total_rooms'))
           // ->select('sessions.channel_id', DB::raw('COUNT(sessions.channel_id) AS total_sessions'))
           ->groupBy('channel_id')
           ->get();*/

    return view('EventOverview', compact('event', 'ticket', 'session', 'room', 'channel', 'data'));
    // return view('EventOverview', compact('event', 'ticket', 'session', 'room', 'channel', 'sessionArr'));
  }
}
