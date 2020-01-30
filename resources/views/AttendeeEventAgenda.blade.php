@extends('layouts.attendeeApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
{{--                <h1>{{$event->event_name}}</h1>--}}
                {!! Form::open(['method'=>'POST','action'=>['AttendeeController@eventRegister', $event[0]->event_slug]]) !!}
                @foreach($tickets_left as $id=>$qty)
                {!! Form::hidden($id, $qty) !!}
                @endforeach
                {!! Form::submit('Register for this event',['class'=>'btn btn-primary float-right']) !!}
                {!! Form::close() !!}
                <table class="table table-striped tg">
                    <tr>
                        <th class="tg-0lax" colspan="{{count($channel)}}">Channel</th>
                        <th class="tg-0lax" colspan="{{count($room)}}">Rooms</th>
                        <th class="tg-0lax" colspan="{{count($session)}}">Timings</th>
                    </tr>
                    <tr>
                        @foreach($channel as $c)
                        <td class="tg-0lax">{{$c->channel_name}}</td>
                        @endforeach
                        @foreach($room as $r)
                        <td class="tg-0lax">{{$r->room_name}}</td>
                        @endforeach
                        @foreach($session as $s)
                        <td class="tg-0lax">{{$s->title}}</td>
                        @endforeach
                    </tr>
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
