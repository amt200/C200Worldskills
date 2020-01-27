<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Special_validity_type;
use DateTime;
use DateTimeZone;
use App\Event;
use App\Ticket;
use Validator;
use DB;


class TicketController extends Controller
{
  public function index($slug)
  {
    // Get slug
    $event = Event::where('event_slug', '=', $slug)->first();

    // Get the special validity data 
  	$types = $this->getSpecialValidityTypes();


    return view('CreateTicket', compact('event', 'types'));
  }

  public function create(Request $request, $slug)
  {
    // Get slug
    $event = Event::where('event_slug', '=', $slug)->first();

  	if($request->isMethod('post') )
    {
      $validator = Validator::make($request -> all(), [
        'ticket_name' => 'required',
        'ticket_cost' => 'required',
        'special_validity' => 'required',
        'max_tickets' => 'required',
        'ticket_end_date' => 'required'
      ]);

      if($validator->fails())
      {
        return redirect('event/'.$slug.'/create_ticket')->withErrors($validator);
      }
      else
      {
        $eventId = $event->id;

        $ticket = new Ticket;
        $ticket_end_date = new DateTime($request->ticket_end_date);
        $ticket->ticket_name = $request->ticket_name;
        $ticket->event_id = $eventId;
        $ticket->ticket_cost = $request->ticket_cost;
        $ticket->special_validities_id = $request->special_validity;
        $ticket->max_tickets = $request->max_tickets;
        $ticket->tickets_left = $request->max_tickets;
        $ticket->tickets_sell_by_date = $ticket_end_date;
        $insert = $ticket->save();

        if($insert)
        {
          return redirect('event/'.$slug)->with('success', 'Ticket successfully created');
        }
        else
        {
          return redirect('event/'.$slug.'/create_ticket')->with('alertmessage', "An error occurred when creating the ticket. Please try again.");
        }
      }
    }
    return view('EventOverview');
  }

  private function getSpecialValidityTypes(){
  	$types = [];

  	$validity_type = Special_validity_type::all();

  	foreach ($validity_type as $type) {
  		$value = $type->validity_type;
  		$key = $type->id;
  		$types[$key] = $value;
  	}

  	return $types;
  }
}
