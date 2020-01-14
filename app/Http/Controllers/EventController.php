<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

use App\Event;

class EventController extends Controller
{
  public function Index()
  {
    $events = \DB::table('events')->get();

    return view('ManageEvent')->with(['events' => $events]);
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
        $event->register_id = $request->register;
        $event->sessions_id = $request->sessions;
        $event->ticket_id = $request->ticket;
        $event->channel_id = $request->channel;
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
