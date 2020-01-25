<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;

use App\Event;

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
        $event->event_registrations = $request->event_registrations;
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

  public function getSlug($slug){
    // Get slug from database
    // $event = \DB::table('events')->where('event_slug', $slug)->first();
    $event = Event::where('event_slug', '=', $slug)->first();

    // Return view
    return view('EventOverview')->with(['events' => $event]);
  }
}
