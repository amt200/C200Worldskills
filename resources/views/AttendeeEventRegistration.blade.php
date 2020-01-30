@extends('layouts.attendeeApp')

@section('content')
    <div class="panel-heading">

        <h2 class="mt-3 mb-3">WorldSkills Conference 2019</h2>
        <hr/>
        <form id="formRegister" method = "post" action="{{url('/attendee/home')}}">

            {{--                <div class="form-check-inline">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <input type="checkbox" id="check1" name="ticket[]" value={{$ticket_name ?? ''_name->id}} class="ticket form-check-input><label>{{$ticket_name ?? ''_name->ticket_type}}</label>{{$ticket_name ?? ''_name->ticket_price}}--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="form-check-inline">--}}
            {{--                        @foreach($ticketData as $i)--}}
            {{--                            <div class="ticketCB">--}}
            {{--                                 {{Form::checkbox('name', $i->ticket_cost)}}--}}
            {{--                                {{$i->ticket_name}} {{$i->ticket_cost}}--}}
            {{--                                @error('name')--}}
            {{--                                <div>{{$message}}</div>--}}
            {{--                                @enderror--}}
            {{--                            </div>--}}
            {{--                        @endforeach--}}
            {{--                </div>--}}

            {{--                <div class="form-check-inline">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <input type="checkbox" id="check3" name="ticket[]" value={{$ticket_name ?? ''_name->id}} class="ticket form-check-input"><label>{{$ticket_name ?? ''_name->ticket_type}}</label>{{$ticket_name ?? ''_name->ticket_price}}--}}
            {{--                        </div>--}}
            {{--                    </div>--}}


            {{--                </div>--}}
            {{--            </div>--}}

            {{--                <div class="form-check">--}}
            {{--                    <label class="form-check-label" for="check1">--}}
            {{--                        <input type="checkbox" id="check1" name="additional[]" value={{$event->id}} class="workshop form-check-input">{{ $event->event_name }}--}}
            {{--                    </label>--}}
            {{--                </div>--}}
            {{--                <div class="form-check">--}}
            {{--                    <label class="form-check-label" for="check2">--}}
            {{--                        <input type="checkbox" id="check2" name="additional[]" value="g" class="workshop form-check-input">Education ecosystem--}}
            {{--                    </label>--}}
            {{--                </div>--}}
            {{--                <div class="form-check">--}}
            {{--                    <label class="form-check-label" for="check3">--}}
            {{--                        <input type="checkbox" id="check3" name="additional[]" value="g" class="workshop form-check-input">Training and innovate--}}
            {{--                    </label>--}}
            {{--            <div class="form-group">--}}
            {{--                @csrf--}}
            {{--                <div class="row" style="display: flex">--}}
            {{--                    <div class="grid-container-events">--}}
            {{--                        @if(count($ticketData) < 1)--}}
            {{--                            <div class="alert alert-warning" role="alert">--}}
            {{--                                All tickets are sold out..--}}
            {{--                            </div>--}}
            {{--                        @else--}}
            {{--                            @foreach($ticketData as $ticket)--}}
            {{--                                <div class="card grid-item">--}}
            {{--                                    <div class="card-body">--}}
            {{--                                        <h5 class="card-title">{{ $ticket->ticket_name}}</h5>--}}
            {{--                                        <h6 class="card-subtitle mb-2 text-muted"> {{Form::checkbox('name', $ticket->ticket_cost)}}.-</h6>--}}
            {{--                                        <br>--}}
            {{--                                        <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->tickets_left }} tickets available</h6>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            @endforeach--}}
            {{--                        @endif--}}
            {{--                    </div>--}}{{-- End grid-container-events--}}
            {{--                </div>--}}{{-- End ticket row --}}
            <div class="form-group">
                @csrf
                <div class="row" style="display: flex">
                    <div class="grid-container-events">
                        @if(count($ticketData) < 1)
                            <div class="alert alert-warning" role="alert">
                                All tickets are sold out..
                            </div>
                        @else
                            @foreach($ticketData as $ticket)
                                <div class="card grid-item" >
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $ticket->ticket_name}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{Form::checkbox('name', $ticket->ticket_cost)}}{{ $ticket->ticket_cost}}.-</h6>
                                        <br>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->tickets_left }} tickets available</h6>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>{{-- End grid-container-events--}}
                </div>{{-- End ticket row --}}

            </div>
            <div class="form-group">
                <label class="title">Select Additional Workshops you want to book:</label><br>
                @foreach($sessionData as $i)
                    <div class="options">

                        {{Form::checkbox('session', $i->cost)}}

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

@endsection
