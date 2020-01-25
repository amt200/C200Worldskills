@extends('layouts.master')

@section('content')


<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-10">
 			<h2>{{ $event->event_name ?? ''}}</h2>
 			<h5>{{ $event->event_date->format('F d, Y') ?? ''}}</h5>
		</div>

		<div class="col-2">
			<a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Edit event<a href=""></a>
		</div>
	</div>
	<hr>
</div>

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Tickets</h2>
		</div>
		<div class="col-2">
			<a href="{{ url('event/'.$event->event_slug.'/ticket-create') }}" class="btn btn-outline-primary" style="float: right">Create new ticket<a href=""></a>
		</div>
	</div>

	<div class="grid-container-events">
		@if(count($ticket) < 1)
			<div class="alert alert-warning" role="alert">
		  	There are no tickets currently..
			</div>
		@else
			@foreach($ticket as $ticket)
			<div class="card grid-item">
			  <div class="card-body">
			    <h5 class="card-title">{{ $ticket->ticket_name}}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->ticket_cost}}.-</h6>
			    <br>
			    <h6 class="card-subtitle mb-2 text-muted">Available until {{ $ticket->tickets_sell_by_date->format('F d, Y') }}</h6>
			    <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->tickets_left }} tickets available</h6>
			  </div>
			</div>
			@endforeach
		@endif
	</div>{{-- End grid-container-events--}}
</div>{{-- End ticket row --}}

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Sessions</h2>
		</div>
		<div class="col-2">
			<a href="{{route('event.create_session')}}" class="btn btn-outline-primary" style="float: right">Create new session<a href=""></a>
		</div>
	</div>

	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th class="w-10">Time</th>
			      <th class="w-10">Type</th>
			      <th class="w-50">Title</th>
			      <th class="w-10">Speaker</th>
			      <th class="w-10">Channel</th>
			    </tr>
			  </thead>
			  <tbody>

					@foreach($session as $session)
			    <tr>
			      <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
			      <td>{{ $session->session_type->type }}</td>
			      <td><a href="">{{ $session->title }}</a></td>
			      <td>{{ $session->speaker }}</td>
			      <td>{{ $session->channel->channel_name }} / {{ $session->room->room_name}}</td>
			    </tr>
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
		<div class="col-2">
			<a href="{{route('event.create_channel')}}" class="btn btn-outline-primary" style="float: right">Create new channel<a href=""></a>
		</div>
	</div>

	<div class="grid-container-events">
		@foreach($channel as $channel)
		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">{{ $channel->channel_name }}</h5>
		    @foreach($sessionArr as $key=>$value)
		    	@if($key == $event->id)
			    <h6 class="card-subtitle mb-2 text-muted">{{ $value }} sessions, {{ $roomArr[$key] }} rooms</h6>
		    	@endif
		    @endforeach
		  </div>
		</div>	
		@endforeach
	</div>
</div> {{-- End Channel row --}}

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Rooms</h2>
		</div>
		<div class="col-2">
			<a href="{{route('event.create_room')}}" class="btn btn-outline-primary" style="float: right">Create new room<a href=""></a>
		</div>
	</div>

	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th class="w-50">Name</th>
			      <th class="w-50">Capacity</th>
			    </tr>
			  </thead>
			  <tbody>
					
					@foreach($room as $room)
			    <tr>
			      <td>{{ $room->room_name }}</td>
			      <td>{{ $room->room_capacity }}</td>
			    </tr>
			    @endforeach

			  </tbody>
			</table>
		</div> {{-- End col 12--}}
	</div> {{-- End row--}}
</div> {{-- End Session row--}}



@endsection