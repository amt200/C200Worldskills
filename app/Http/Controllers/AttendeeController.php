<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendeeController extends Controller
{
    public function dashboard(){
        return view('AttendeeDashBoard');
    }

    public function eventAgenda($slug){
        $getEventIdBySlug = DB::table('events')->select('id')->where('event_slug','=', $slug)->get();

        $event_id = $getEventIdBySlug[0]->id;
        $formatted_timings = [];


        $getSessionByEvent = DB::table('sessions')->where('event_id','=', $event_id)->get();

        $getChannelByEvent = DB::table('channels')->where('event_id','=', $event_id)->get();

        $getRoomByEvent = DB::table('rooms')->where('event_id','=', $event_id)->get();

        $allData = [$getChannelByEvent, $getSessionByEvent, $getRoomByEvent];
        dd($allData);
        return view('EventAgenda', compact(['slug', 'formatted_timings', 'allData']));
    }
    public function eventRegister()
    {
        $events = DB::table('events')->get();
        $ticket = DB::table('tickets')->get();
        return view('AttendeeEventRegistration')->with(['ticket_cost' =>$ticket, 'ticket_name' => $ticket, 'event_name' => $events]);
    }
    public  function sessionDetails()
    {
        return view('AttendeeSessionDetails');
    }

}
