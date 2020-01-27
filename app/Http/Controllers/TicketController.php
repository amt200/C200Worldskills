<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Special_validity_type;
use App\Event;
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

  public function create(Request $request)
  {
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
        return redirect()->route('event.ticket_create')->withErrors($validator);
      }
      else
      {
        $ticket = new Ticket;
        $ticket->ticket_name = $request->ticket_name;
        $ticket->event_id = 1;
        $ticket->ticket_cost = $request->ticket_cost;
        $ticket->special_validity_id = $request->id;
        $ticket->max_tickets= $request->max_tickets;
        $ticket->tickets_left= $request->max_tickets;
        $insert = $ticket->save();

        if($insert)
        {
          return redirect()->route('event')->with('success', 'Ticket successfully created');
        }
        else
        {
          return redirect()->route('event.ticket_create')->with('error', 'An error occured while creating ticket');
        }
      }
    }
    return view('CreateTicket');
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
