@extends('layouts.master')

@section('content')

<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-8">
 			<h2>Edit Event Details</h2>
		</div>

		<div class="col-4">
      <div class="right" style="float: right;">
				<a href="{{ url('event/'.$event->event_slug) }}">Cancel</a>
      </div>
		</div>
	</div>
	<hr>
</div>

<form method="POST" action="{{action('EventController@updateEvent',['slug' => $event->event_slug])}}">
	@csrf
	<div class="form-group row event-detail-sections">
		<div class="col-4">
			<label for="id_event_name">Event Name</label>
			<input type="text" class="form-control" id="id_event_name" name="event_name" value="{{ $event->event_name }}">
		</div>

		<div class="col-4">
			<label for="id_event_slug">Event Slug</label>
			<input type="text" class="form-control" id="id_event_slug" name="event_slug" value="{{ $event->event_slug }}">
		</div>

		<div class="col-4">
			<label for="id_event_slug">Event Date</label>
			<input type="text" class="form-control" id="id_event_slug" name="event_slug" value="{{ $event->event_date }}" disabled="">
		</div>
	</div>
	<div class="row">
		<div class="left col-6" >
		</div>
		<div class="right col-6" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<form action="{{action('EventController@deleteEvent',['slug' => $event->event_slug])}}" method="POST">
			    <input type="hidden" name="_method" value="DELETE">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <input onclick="return confirm('Are you sure you want to delete event: {{ $event->event_name }}?')" type="submit" class="btn btn-danger" value="Delete"/>
			</form>
			<input type="submit" class="btn btn-primary mr-5" value="Save" style="float: right;"/>
		</div>
	</div>
</form>

	<hr>

	<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Tickets</h2>
		</div>
	</div>

	<form method="POST" action="{{action('EventController@updateEvent',['slug' => $event->event_slug])}}">
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th class="w-10">Ticket Name</th>
	      <th class="w-20">Cost</th>
	      <th class="w-20">Sell By</th>
	      <th class="w-10">Tickets Left</th>
	      <th class="w-10">Actions</th>
	    </tr>
	  </thead>
	  <tbody>

			@foreach($ticket as $ticket)
				@if($ticket->event_id == $event->id)
		    <tr>
		      <td>{{ $ticket->ticket_name }}</td>
		      <td>{{ $ticket->ticket_cost }}</td>
		      <td>{{ $ticket->tickets_sell_by_date->format('F d, Y') }}</td>
		      <td>{{ $ticket->tickets_left }}</td>
		      <td>
		      	<a href="" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
		      	<a onclick="return confirm('Are you sure you want to delete ticket: {{ $ticket->ticket_name }}?')" href="{{ route('event.delete_ticket', ['slug' => $event->event_slug, 'id' => $ticket->id]) }}" class="delete-btn"><i class="fas fa-trash"></i> Delete</a>
		      </td>
		    </tr>
		    @endif
	    @endforeach

	  </tbody>
	</table>
    </form>

</div>{{-- End ticket row --}}


<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Sessions</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th class="w-10">Time</th>
			      <th class="w-10">Type</th>
			      <th class="w-20">Title</th>
			      <th class="w-10">Speaker</th>
			      <th class="w-30">Channel(s)</th>
			      <th class="w-10">Actions</th>
			    </tr>
			  </thead>
			  <tbody>

					@foreach($session as $session)
						@if($session->event_id == $event->id)
				    <tr>
				      <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
				      <td>{{ $session->session_type->type }}</td>
				      <td><a href="">{{ $session->title }}</a></td>
				      <td>{{ $session->speaker }}</td>
				      <td>{{ $session->channel->channel_name }} / {{ $session->room->room_name}}</td>
				      <td>
				      	<a href="{{route('event.update_session',["slug"=>$event->event_slug, "id"=>$session->id])}}" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
				      	<a href="{{route('event.delete_session',["slug"=>$event->event_slug,"id"=>$session->id])}}" class="delete-btn"><i class="fas fa-trash"></i> Delete</a>
				      </td>
				    </tr>
				    @endif
			    @endforeach

			  </tbody>
			</table>
		</div> {{-- End col 12 --}}
	</div> {{-- End row --}}
</div> {{-- End Session row --}}

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Channels</h2>
		</div>
	</div>

	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th class="w-10">Channel Name</th>
	      <th class="w-10">Actions</th>
	    </tr>
	  </thead>
	  <tbody>

			@foreach($channel as $channel)
				@if($channel->event_id == $event->id)
		    <tr>
		      <td>{{ $channel->channel_name }}</td>
		    	<td><a href="{{route('event.update_channel',["slug"=>$event->event_slug, "id"=>$channel->id])}}" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                    <a href="{{route('event.delete_channel',["slug"=>$event->event_slug, "id"=>$channel->id])}}" class="delete-btn"><i class="fas fa-trash"></i> Delete</a></td>
		    </tr>
		    @endif
	    @endforeach

	  </tbody>
	</table>
</div> {{-- End Channel row --}}

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Rooms</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th class="w-30">Name</th>
			      <th class="w-30">Capacity</th>
			      <th class="w-30">Actions</th>
			    </tr>
			  </thead>
			  <tbody>

					@foreach($room as $room)
					@if($room->event_id == $event->id)
			    <tr>
			      <td>{{ $room->room_name }}</td>
			      <td>{{ number_format($room->room_capacity) }}</td>
			      <td><a href="" class="edit-btn"><i class="fas fa-edit"></i> Edit</a> <a href="" class="delete-btn"><i class="fas fa-trash"></i> Delete</a></td>
			    </tr>
			    @endif
			    @endforeach

			  </tbody>
			</table>
		</div> {{-- End col 12--}}
	</div> {{-- End row--}}
</div> {{-- End Session row--}}

@endsection
