@extends('layouts.master')

@section('content')
<div class="panel-heading">
<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-12">
 			<h2>{{ $event->event_name ?? ''}}</h2>
 			<h5>{{ $event->event_date->format('F d, Y') ?? ''}}</h5>
		</div>
	</div>
	<hr>
</div>
	<h4 class="mt-3 mb-5">Edit ticket</h4>

	<form method="POST" action="{{action('TicketController@storeUpdateTicket', ['slug' => $event->event_slug])}}">
		@csrf

		<div class="form-group row">
			<div class="col-4">
				<label for="id_ticket_name">Name</label>
				<input type="text" class="form-control" id="id_ticket_name" name="ticket_name" value="{{ $ticket->ticket_name }}">
			</div>
		</div>
	
		<div class="form-group row">
			<div class="col-4">
				<label for="id_ticket_cost">Cost</label>
				<input type="text" class="form-control" id="id_ticket_cost" name="ticket_cost" value="{{ $ticket->ticket_cost }}">
			</div>
		</div>
	

		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<label for="id_max_tickets">Maximum amount of tickets to be sold</label>
					<input type="text" class="form-control" id="id_max_tickets" name="max_tickets" value="{{ $ticket->max_tickets }}" disabled>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<label for="id_tickets_left">Tickets Left</label>
					<input type="text" class="form-control" id="id_tickets_left" name="tickets_left" value="{{ $ticket->tickets_left }}">
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<label for="id_ticket_end_date">Tickets can be sold until</label>
					<input type="text" class="form-control" id="id_ticket_end_date" name="ticket_end_date" value="{{ $ticket->tickets_sell_by_date }}">
				</div>
			</div>
		</div>
	
		<hr/>
	
		<div class="form-group form-inline">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input name="ticketID" type="hidden" value="{{ $ticket->id }}">
			<input type="submit" class="btn btn-primary mr-5" value="Save Ticket" />
			<a href="{{ url('event/'.$event->event_slug) }}">Cancel</a>
		</div>
	</form>
</div>


@endsection