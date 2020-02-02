<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class AttendeeController extends Controller
{
    public function dashboard()
    {
        $list = DB::table('organizers')
            ->select('organizers.name', 'events.*')
            ->join('events', 'organizers.id', 'events.organizer_id')
            ->get();

        $data = $list;
        return view('AttendeeDashBoard')->with(['event_name' => $data,'event_date' => $data, 'name' => $data]);

    }


    public function eventRegister($slug){

        $findEventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
        $eventName = $findEventBySlug[0]->event_name;
        $findSessionByEvent = DB::table('sessions')->where([['event_id', '=', $findEventBySlug[0]->id],['session_type_id', '=', 2]])->get();
        $findTicketByEvent = DB::table('tickets')->where('event_id', '=', $findEventBySlug[0]->id)->get();

        return view('AttendeeEventRegistration', compact(['slug','eventName','findSessionByEvent','findTicketByEvent']));

    }
    public function update(Request $request, $slug)
    {

        $getEventIdBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
        $ticket = DB::table('tickets')->select('*')->where('event_id', '=', $getEventIdBySlug[0]->id)->get();
        $selectedTickets = $request->ticketCostCB;
        dd($selectedTickets);
        foreach ($selectedTickets as $t) {
            $ticketLeft = DB::table('tickets')->where('id', '=', (int)$t )->get();
            $tl= $ticketLeft[0]->tickets_left - 1;



            DB::table('tickets')->where('id', '=', (int)$t)->update(['tickets_left' => $tl]);

        }
        return redirect('/attendee/home');

    }


    public function eventAgenda($slug)
    {

        $event = DB::table('events')->where('event_slug','=', $slug)->get();
        $room = DB::table('rooms')->where('event_id','=', $event[0]->id)->get();
        $channel = DB::table('channels')->where('event_id','=', $event[0]->id)->get();
        $session = DB::table('sessions')
            ->select('sessions.*', 'channels.channel_name', 'rooms.room_name', 'session_types.type')
            ->join('rooms', 'sessions.room_id', 'rooms.id')
            ->join('channels', 'sessions.channel_id', 'channels.id')
            ->join('session_types', 'sessions.session_type_id', 'session_types.id')
            ->where('sessions.event_id','=', $event[0]->id)
            ->get();

        return view('AttendeeEventAgenda', compact(['session', 'room', 'channel', 'event']));
    }

    public  function sessionDetails($slug)
    {

        $findEventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
        $findSessionByEvent = DB::table('sessions')->where('event_id', '=', $findEventBySlug[0]->id)->get();
        return view('AttendeeSessionDetails', compact(['findSessionByEvent']));
    }
//    public function formSubmit(Request $req)
//    {
//        print_r($req->input());
//    }
    public function getSlug($slug){
        // Get slug from database
        // $event = \DB::table('events')->where('event_slug', $slug)->first();
        $event = Event::where('event_slug', '=', $slug)->first();

        // Return view
        return view('AttendeeEventAgenda')->with(['events' => $event]);

    }


}
