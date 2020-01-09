@extends('layouts.master')

@section('content')
<div class="panel-heading">
	<h2 class="mt-3 mb-3">Manage Events</h2>
	<hr/>
	<h4 class="mt-3 mb-5">Create new event</h4>

	<form method="POST" action="{{action('EventController@create')}}">
		@csrf
		<div class="form-group row">
			<div class="col-4">
				<label for="id_event_name">Name</label>
				<input type="text" class="form-control" id="id_event_name" name="event_name">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-4">
				<label for="id_event_slug">Slug</label>
				<input type="text" class="form-control" id="id_event_slug" name="event_slug">
			</div>
		</div>

		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<label for="id_event_date">Date</label>
					<input type="text" class="form-control" id="id_event_date" name="event_date">
				</div>
			</div>
		</div>

		<hr/>

		<div class="form-group form-inline">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="submit" class="btn btn-primary mr-5" value="Save event" />
			<a href="{{route('event')}}">Cancel</a>
		</div>
	</form>
</div>


@endsection