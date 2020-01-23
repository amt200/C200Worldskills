@extends('layouts.master')

@section('content')


<div class="panel-heading">
	<div class="row" style="display: flex">
		<div class="col-10">
	    <!--<h2>// //$events->event_name </h2>-->
		</div>

		<div class="col-2">
			<a href="{{route('event.create')}}" class="btn btn-outline-primary" style="float: right">Edit event<a href=""></a>
		</div>
	</div>
	<hr>

</div>


@endsection
