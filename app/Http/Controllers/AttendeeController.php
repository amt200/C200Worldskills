<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Ticket;
use App\Organizer;
use App\Session;
use App\Channel;
use App\Room;
use Validator;
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


    public function eventRegister(Request $request)
    {
//        $details = DB::table('events')
//            ->select('tickets.ticket_name', 'tickets.ticket_cost', 'tickets.max_tickets')
//            ->join('tickets', 'events.id', 'tickets.event_id')
//            ->get();
//        $data = $details;
       $session = \DB::table('sessions')->get();
        $ticket = \DB::table('tickets')->get();
        $sessionData = $session;
        $ticketData = $ticket;
        return view('AttendeeEventRegistration', compact(['sessionData', 'ticketData'])) ;
//        return view('AttendeeEventRegistration')->with(['ticket_cost' =>$ticket, 'ticket_name' => $ticket, 'title' => $data]);
//        return view('AttendeeEventRegistration')->with(['ticket_cost' =>$ticket, 'ticket_name' => $ticket, 'event_name' => $events]);

    }
//    public function eventAgenda($slug)
//    {
//
//        $session = \DB::table('sessions')->get();
//        $room = \DB::table('rooms')->get();
//        $channel = \DB::table('channels')->get();
//        $sessionData = $session;
//        $roomData = $room;
//        $channelData = $channel;
//            $event = Event::where('event_slug', '=', $slug)->first();
//            return view('AttendeeEventAgenda', compact(['sessionData', 'roomData', 'channelData', 'event']));
//
////        return view('AttendeeEventAgenda', compact(['sessionData', 'roomData', 'channelData', 'event']));
//    }
    public function eventAgenda($slug){
        $getEventIdBySlug = DB::table('events')->select('id')->where('event_slug','=', $slug)->get();

        $event_id = $getEventIdBySlug[0]->id;
        $formatted_timings = [];
        $groupedData = [];


        $getSessionByEvent = DB::table('sessions')->where('event_id','=', $event_id)->get();

        $getChannelByEvent = DB::table('channels')->where('event_id','=', $event_id)->get();

        $getRoomByEvent = DB::table('rooms')->where('event_id','=', $event_id)->get();

        foreach ($getChannelByEvent as $channel){
            array_push($groupedData, [$channel]);
        }
        $count = 0;
        $selectedIDs = [];

        foreach ($getRoomByEvent as $room){
            $channel_index = $room->channel_id-1;

            if($count == 0){
                array_push($groupedData[$channel_index], [$room]);
            }
            else{
                if ($selectedIDs[count($selectedIDs)-1] == $room->channel_id) {
                    array_push($groupedData[$channel_index][1], $room);
                }
                else{
                    array_push($groupedData[$channel_index], [$room]);
                }
            }
            $count += 1;

            if(in_array($room->channel_id, $selectedIDs) == false){
                array_push($selectedIDs, $room->channel_id);
            }
        }
        $num = 0;
        $idStack = [];

        foreach ($getSessionByEvent as $session){
            $channel_index = $session->channel_id-1;

            if($num == 0){
                array_push($groupedData[$channel_index], [$session]);
            }
            else{
                if ($idStack[count($idStack)-1] == $session->channel_id) {
                    array_push($groupedData[$channel_index][2], $session);
                }
                else{
                    array_push($groupedData[$channel_index], [$session]);
                }
            }
            $num += 1;

            if(in_array($session->channel_id, $idStack) == false){
                array_push($idStack, $session->channel_id);
            }
        }
//        dd($groupedData);
        foreach ($getSessionByEvent as $session){
            array_push($formatted_timings, substr($session->start_time, 11, 5));
        }

        return view('AttendeeEventAgenda', compact(['slug', 'formatted_timings', 'groupedData']));
    }
    public  function sessionDetails($slug)
    {
        $getEventIdBySlug = DB::table('events')->select('id')->where('event_slug','=', $slug)->get();

        $event_id = $getEventIdBySlug[0]->id;
        $getSessionByEvent = DB::table('sessions')->where('event_id','=', $event_id)->get();
        return view('AttendeeSessionDetails', compact(['getSessionByEvent']));
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
    public function ticketUpdate($slug){

        $getEventIdBySlug = DB::table('events')->select('id')->where('event_slug','=', $slug)->get();

    }

}
