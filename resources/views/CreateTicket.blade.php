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

@include('layouts.flash-messages')

	@if (session('alertmessage'))
    <p style="color:red">{{ session('alertmessage')}}</p>
  @endif
	<h4 class="mt-3 mb-5">Create new ticket</h4>

	<form method="POST" action="{{action('TicketController@create', ['slug' => $event->event_slug])}}">
		@csrf
		<div class="form-group row">
			<div class="col-4">
				<label for="id_ticket_name">Name</label>
				<input type="text" class="form-control" id="id_ticket_name" name="ticket_name">

				@if ($errors->has('ticket_name'))
          <p class="text-danger">{{$errors->first('ticket_name')}}</p>
        @endif
			</div>
		</div>
	
		<div class="form-group row">
			<div class="col-4">
				<label for="id_ticket_cost">Cost</label>
				<input type="text" class="form-control" id="id_ticket_cost" name="ticket_cost" placeholder="0">

				@if ($errors->has('ticket_cost'))
          <p class="text-danger">{{$errors->first('ticket_cost')}}</p>
        @endif
			</div>
		</div>

		<script>
			$(document).ready(function (){
					document.getElementById("showEndDate").style.display = "none";	
			});
			function yesnoCheck(that) {
				if (that.value == 2) {
					document.getElementById("showEndDate").style.display = "block";
				} else if (that.value == 3) {
					document.getElementById("showEndDate").style.display = "none";
				} else {
					document.getElementById("showEndDate").style.display = "none";
				}
			}
		</script>
	
		<div class="form-group row">
			<div class="col-4">
				<label for="id_special_validity">Special Validity</label>
					<select onchange="yesnoCheck(this);" class="form-control" name="special_validity" id="id_special_validity">
						@foreach($types as $key=>$value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>

					@if ($errors->has('special_validity'))
          <p class="text-danger">{{$errors->first('special_validity')}}</p>
        	@endif
			</div>
		</div>
	
		<div class="row" id="showLimitedTickets">
			<div class="col-4">
				<div class="form-group">
					<label for="id_max_tickets">Maximum amount of tickets to be sold</label>
					<input type="text" class="form-control" id="id_max_tickets" name="max_tickets" placeholder="0">

					@if ($errors->has('max_tickets'))
          	<p class="text-danger">{{$errors->first('max_tickets')}}</p>
        	@endif
				</div>
			</div>
		</div>
	
		<div class="row" id="showEndDate">
			<div class="col-4">
				<div class="form-group">
					<label for="id_ticket_end_date">Tickets can be sold until</label>
					<input type="text" class="form-control" id="id_ticket_end_date" name="ticket_end_date" placeholder="yyyy-mm-dd HH:MM">

					@if ($errors->has('ticket_end_date'))
          	<p class="text-danger">{{$errors->first('ticket_end_date')}}</p>
       		@endif
				</div>
			</div>
		</div>
	
		<hr/>
	
		<div class="form-group form-inline">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="submit" class="btn btn-primary mr-5" value="Save Ticket" />
			<a href="{{ url('event/'.$event->event_slug) }}">Cancel</a>
		</div>
	</form>
</div>


@endsection