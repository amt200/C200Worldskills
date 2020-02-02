@extends('layouts.master')

@section('content')
<div class="panel-heading">
	<h2 class="mt-3 mb-3">Manage Events</h2>
	<hr/>
	<h4 class="mt-3 mb-5">Create new event</h4>

	@include('layouts.flash-messages')

	@if (session('alertmessage'))
    <p style="color:red">{{ session('alertmessage')}}</p>
  @endif

	<form method="POST" action="{{action('EventController@create')}}">
		@csrf
		<div class="form-group row">
			<div class="col-4">
				<label for="id_event_name">Name</label>
				<input type="text" class="form-control" id="id_event_name" name="event_name">

				@if ($errors->has('event_name'))
          <p class="text-danger">{{$errors->first('event_name')}}</p>
        @endif
			</div>
		</div>

		<div class="form-group row">
			<div class="col-4">
				<label for="id_event_slug">Slug</label>
				<input type="text" class="form-control" id="id_event_slug" name="event_slug">

				@if ($errors->has('event_slug'))
          <p class="text-danger">{{$errors->first('event_slug')}}</p>
        @endif
			</div>
		</div>

		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<label for="id_event_date">Date</label>
					<input type="text" class="form-control" id="id_event_date" name="event_date" placeholder="yyyy-mm-dd">

					@if ($errors->has('event_date'))
	          <p class="text-danger">{{$errors->first('event_date')}}</p>
	        @endif
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