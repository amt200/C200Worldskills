@extends('layouts.master')

@section('content')
<div>
    <h2 class="mt-3 mb-3">WorldSkills Conference 2019</h2>
    <hr/>
    <h4 class="mt-3 mb-5">Create new room</h4>

    {!! Form::open(['method'=>'POST','action'=>'RoomController@store']) !!}
    <div class="form-group row">
        <div class="col-4">
            {!! Form::label('id_room_name','Room Name') !!}
            {!! Form::text('room_name', null, ['class'=> $errors->has('room_name') ? 'form-control border-danger': 'form-control', 'id'=>'id_room_name']) !!}
            @if ($errors->has('room_name'))
                <p class="text-danger">{{$errors->first('room_name')}}</p>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-4">
            {!! Form::label('id_channel','Channel') !!}
            {!! Form::select('channel', $channel_names, 1, ['class'=>'form-control', 'id'=>'id_channel']) !!}
        </div>
    </div>
    <div class="form-group row mb-5">
        <div class="col-4">
            {!! Form::label('id_room_capacity','Capacity') !!}
            {!! Form::number('room_capacity', null, ['class' => 'number form-control', 'id' => 'id_room_capacity']) !!}
        </div>
    </div>
    <hr/>
    <div class="form-group form-inline">
        {!! Form::submit('Save room',['class'=>'btn btn-primary mr-5']) !!}
        <a href="{{route('event.details')}}">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>


@endsection
