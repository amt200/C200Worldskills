@extends('layouts.attendeeApp')

@section('content')
    <div class="panel-heading">

        <h2 class="mt-3 mb-3">{{$eventName}}</h2>
        <hr/>
        <form method="POST" action="{{action('AttendeeController@update',['slug' => $slug])}}">
            @csrf

            <div class="grid-container-events">
                @csrf
                <div class="row" style="display: flex">

                    <div class="grid-container-events">
                        @if(count($findTicketByEvent) < 1)
                            <div class="alert alert-warning" role="alert">
                                All tickets are sold out..
                            </div>
                        @else
                            @foreach($findTicketByEvent as $ticket)
                                <div class="card grid-item" >
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $ticket->ticket_name}}</h5>
                                        {{--                                        <h6 class="card-subtitle mb-2 text-muted"> {{Form::checkbox('name', $ticket->id}}<span>{{ $ticket->ticket_cost}}.-</span></h6>--}}
                                        <h6>{{Form::checkbox('ticketCostCB[]', $ticket->id)}}{{$ticket->ticket_cost}}</h6>
                                        <br>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->tickets_left }} tickets available</h6>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        {{--                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />--}}
                        {{--                            <input type="submit" class="btn btn-primary mr-5" value="Save" style="float: right;"/>--}}


                    </div>

                </div>
                <div class="form-group">
                    <label class="title">Select Additional Workshops you want to book:</label><br>
                    @foreach($findSessionByEvent as $i)
                        <div class="options">
                            {{Form::checkbox('session[]', $i->cost)}}
                            {{$i->title}}
                        </div>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <div class="float-right align-content-around">
                    <label>Event Ticket:</label><div id="ticketPrice"></div>
                    Additional Workshops:<div id="sessionCost"></div> <br>
                    <hr>
                    Total: <div id="totalCost"></div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input class=" float-right btn btn-block btn-primary" type="submit"  id="btnSubmit" value="Purchase"/>
                </div>
            </div>

        </form>
@endsection
