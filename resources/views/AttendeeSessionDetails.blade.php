@extends('layouts.attendeeApp')
@section('content')
    <div class="panel-heading">
        @foreach($findSessionByEvent as $i)
            <h2 id="title" class="mt-3 mb-3">{{$i->title}}</h2>
            <p id="description">{{$i->description}} </p>
            <div class="details">
                <h6>Speaker:</h6><div class="data"{{$i->speaker}}/>{{$i->speaker}}
                <h6>Start:</h6>{{$i->start_time}}
                <h6>End:</h6>{{$i->end_time}}
                <h6>Cost:{{$i->cost}}</h6>
                @endforeach
            </div>

    </div>
@endsection
