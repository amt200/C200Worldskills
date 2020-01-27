@extends('layouts.master')

@section('content')


<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-10">
		@if(!empty($events))
				<h2>{{ $events->event_name ?? ''}}</h2>
			@endif

 			<h2>{{ $events->event_name ?? ''}}</h2>
 			<h5>{{ $events->event_date ?? ''}}</h5>
		</div>

		<div class="col-2">
            <a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Edit event<a href=""></a></a>
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
			<a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Create new ticket<a href=""></a>
		</div>
	</div>

	<div class="grid-container-events">
		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">Normal</h5>
		    <h6 class="card-subtitle mb-2 text-muted">200-</h6>
		  </div>
		</div>

		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">Early Bird</h5>
		    <h6 class="card-subtitle mb-2 text-muted">120-</h6>
		    <br>
		    <h6 class="card-subtitle mb-2 text-muted">Available until June 1, 2019</h6>
		  </div>
		</div>

		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">Early Bird</h5>
		    <h6 class="card-subtitle mb-2 text-muted">120-</h6>
		    <br>
		    <h6 class="card-subtitle mb-2 text-muted">Available until June 1, 2019</h6>
		  </div>
		</div>
	</div>

</div>

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Sessions</h2>
		</div>
		<div class="col-2">
			<a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Create new session<a href=""></a>
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

			    {{-- EXAMPLE FOR SESSIONS --}}
			    <tr>
			      <td>08:30 - 10:00</td>
			      <td>Talk</td>
			      <td><a href="">Keynote</a></td>
			      <td>An important person</td>
			      <td>Main / Room A</td>
			    </tr>

			    <tr>
			      <td>08:30 - 10:00</td>
			      <td>Talk</td>
			      <td><a href="">Keynote</a></td>
			      <td>An important person</td>
			      <td>Main / Room A</td>
			    </tr>

			  </tbody>
			</table>
		</div> {{-- End col 12--}}
	</div> {{-- End row--}}
</div> {{-- End Session row--}}

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
		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">Normal</h5>
		    <h6 class="card-subtitle mb-2 text-muted">200-</h6>
		  </div>
		</div>

		<div class="card grid-item">
		  <div class="card-body">
		    <h5 class="card-title">Normal</h5>
		    <h6 class="card-subtitle mb-2 text-muted">200-</h6>
		  </div>
		</div>
	</div>
</div>

<div class="col-12 event-detail-sections">
	<div class="row" style="display: flex">
		<div class="col-10">
			<h2 class="event-detail-title">Rooms</h2>
		</div>
		<div class="col-2">
            <a href="{{route('event.create_room')}}" class="btn btn-outline-primary" style="float: right">Create new room<a href=""></a></a>
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

			    {{-- EXAMPLE FOR SESSIONS --}}
			    <tr>
			      <td>Room A</td>
			      <td>1,000</td>
			    </tr>

			    <tr>
			      <td>Room A</td>
			      <td>1,000</td>
			    </tr>

			    <tr>
			      <td>Room A</td>
			      <td>1,000</td>
			    </tr>

			  </tbody>
			</table>
		</div> {{-- End col 12--}}
	</div> {{-- End row--}}
</div> {{-- End Session row--}}



@endsection
