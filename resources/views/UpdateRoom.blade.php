@extends('layouts.master')

@section('content')
    <div>
        <h2 class="mt-3 mb-3">{{$events[0]->event_name}}</h2>
        <hr/>
        <h4 class="mt-3 mb-5">Update room</h4>

        {!! Form::open(['method'=>'POST','action'=>['RoomController@update', $slug]]) !!}
        @csrf
        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_room_name','Room Name') !!}
                {!! Form::text('room_name', $room_data['room_name'], ['class'=> $errors->has('room_name') ? 'form-control border-danger': 'form-control', 'id'=>'id_room_name']) !!}
                {{ Form::hidden('id', $id) }}
                @if ($errors->has('room_name'))
                    <p class="text-danger">{{$errors->first('room_name')}}</p>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_channel','Channel') !!}
                {!! Form::select('channel', $channel_data, $room_data['channel_id'], ['class'=>'form-control', 'id'=>'id_channel']) !!}
            </div>
        </div>
        <div class="form-group row mb-5">
            <div class="col-4">
                {!! Form::label('id_room_capacity','Capacity') !!}
                {!! Form::number('room_capacity', $room_data['room_capacity'], ['class' => 'number form-control', 'id' => 'id_room_capacity']) !!}
            </div>
        </div>
        <hr/>
        <div class="form-group form-inline">
            {!! Form::submit('Update room',['class'=>'btn btn-primary mr-5']) !!}
            <a href="{{route('event')}}" class="mr-5">Cancel</a>
            <a href="{{route('event.delete_room',["slug"=>$slug,"id"=>$id])}}">Delete Room</a>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
