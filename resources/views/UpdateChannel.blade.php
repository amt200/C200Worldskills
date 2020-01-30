@extends('layouts.master')

@section('content')

    <div>
        <h2 class="mt-3 mb-3">{{$event_name ?? ''}}</h2>
        <hr/>
        <h4 class="mt-3 mb-5">Create new channel</h4>

        {!! Form::open(['method'=>'POST','action'=>['ChannelController@storeUpdate', $slug ?? '']]) !!}
        <div class="form-group row mb-5">
            <div class="col-4">
                {!! Form::label('id_channel_name','Channel Name') !!}
                {!! Form::text('channel_name', $channelData['channel_name'], ['class'=> $errors->has('channel_name') ? 'form-control border-danger': 'form-control', 'id'=>'id_channel_name']) !!}
                {{ Form::hidden('id', $id) }}
                @if ($errors->has('channel_name'))
                    <p class="text-danger">{{$errors->first('channel_name')}}</p>
                @endif
            </div>
        </div>
        <hr/>
        <div class="form-group form-inline">
            {!! Form::submit('Update channel',['class'=>'btn btn-primary mr-5']) !!}
            <a href="{{route('event.overview',["slug"=>$slug])}}">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
