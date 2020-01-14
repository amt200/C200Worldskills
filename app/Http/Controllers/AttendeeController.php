<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class AttendeeController extends Controller
{
    public function index()
    {

    }
    public function dashboard(){
        return view('AttendeeDashBoard');
    }

    public function eventRegister()
    {
        $events = \DB::table('events')->get();
        $ticket = \DB::table('tickets')->get();
        return view('AttendeeEventRegistration')->with(['ticket_cost' =>$ticket, 'ticket_name' => $ticket, 'event_name' => $events]);
    }
    public  function sessionDetails()
    {
        return view('AttendeeSessionDetails');
    }
    function list()
    {
        $data = Event::all();
        return view('AttendeeDashBoard', ['data'=>$data]);
    }

}
