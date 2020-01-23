@extends('layouts.master')

@section('content')

<div>
    <h2 class="mt-3 mb-3"></h2>
    <hr/>
    <h4 class="mt-3 mb-5">Create new channel</h4>

    {!! Form::open(['method'=>'POST','action'=>'ChannelController@store']) !!}
    <div class="form-group row mb-5">
        <div class="col-4">
            {!! Form::label('id_channel_name','Channel Name') !!}
            {!! Form::text('channel_name', null, ['class'=> $errors->has('channel_name') ? 'form-control border-danger': 'form-control', 'id'=>'id_channel_name']) !!}
            @if ($errors->has('channel_name'))
                <p class="text-danger">{{$errors->first('channel_name')}}</p>
            @endif
        </div>
    </div>
    <hr/>
    <div class="form-group form-inline">
        {!! Form::submit('Save channel',['class'=>'btn btn-primary mr-5']) !!}
        
    </div>
    {!! Form::close() !!}

@endsection
