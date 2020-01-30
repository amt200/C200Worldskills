@extends('layouts.attendeeApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
{{--                <h1>{{$event->event_name}}</h1>--}}
                {!! Form::open(['method'=>'POST','action'=>['AttendeeController@eventRegister', $event->event_slug]]) !!}
                {!! Form::submit('Register for this event',['class'=>'btn btn-primary float-right']) !!}
                {!! Form::close() !!}
                            <table id="moduleTable" class="table table-striped table-sm table-bordered"> <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <thead>
                                <tr>
                                    <th>Channel</th>
                                    <th>Room</th>
                                    <th>hi</th>
                                </tr>
                                </thead>
                                @foreach($channelData as $channel)
                                    <tr>
                                        <td>{{$channel->channel_name}}</td>
                                    </tr>
                                    @endforeach
                                @foreach($roomData as $room)
                                        <td >{{$room->room_name}}</td>
                                @endforeach
                            </table>



{{--                            <table class="table">--}}
{{--                                @foreach($channelData -> $channel)--}}
{{--                                    $name = {{$channel ->channel_name}}--}}
{{--                                    @endforeach--}}

{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{$name}}</th>--}}
{{--                                    <td>Mark</td>--}}
{{--                                    <td>Otto</td>--}}
{{--                                    <td>@mdo</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">2</th>--}}
{{--                                    <td>Jacob</td>--}}
{{--                                    <td>Thornton</td>--}}
{{--                                    <td>@fat</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

            </div>
        </div>
    </div>
@endsection
