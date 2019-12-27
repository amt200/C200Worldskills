@extends('layouts.master')

@section('content')
<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-10">
	    <h2>Manage Events</h2>
		</div>

		<div class="col-2">
			<a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Create new event<a href=""></a>
		</div>
	</div>
	<hr>

	@if(count($events) < 1)
	<div class="alert alert-warning" role="alert">
  	There are no events currently..
	</div>

	@else
	<div class="alert alert-primary" role="alert">
  	TOTAL EVENTS : {{count($events)}}
	</div>
	
	<div class="grid-container">
		@foreach($events as $event)
		<div class="card grid-item" style="width: 18rem;">
		  <div class="card-body">
		    <h5 class="card-title">{{ $event->event_name }}</h5>
		    <h6 class="card-subtitle mb-2 text-muted">{{ $event->event_slug }}</h6>
		    <hr>
		    <p class="card-text">{{ $event->id }} registrations</p>
		  </div>
		</div>
		@endforeach
	</div>
	

	@endif
</div>


@endsection