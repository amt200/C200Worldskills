@extends('layouts.master')

@section('content')
<div class="panel-heading">
    <h2 class="mt-3 mb-3">WorldSkills Conference 2019</h2>
    <hr/>
    <h4 class="mt-3 mb-5">Create Session</h4>


    {!! Form::open(['method'=>'POST','action'=>'SessionController@store']) !!}
        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_type','Type') !!}
                {!! Form::select('type', $types, null, ['class'=>'form-control', 'id'=>'id_type']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_title','Title') !!}
                {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'id_title']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_speaker','Speaker') !!}
                {!! Form::text('speaker', null, ['class'=>'form-control', 'id'=>'id_speaker']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_room','Room') !!}
                {!! Form::text('room', null, ['class'=>'form-control', 'id'=>'id_room']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                {!! Form::label('id_cost','Cost') !!}
                {!! Form::text('cost', null, ['class'=>'form-control', 'id'=>'id_cost', 'value'=>'0']) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('id_start','Start') !!}
                    {!! Form::text('start_time', null, ['class'=>'form-control', 'id'=>'id_start','placeholder'=>'yyyy-mm-dd HH:MM']) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('id_end','End') !!}
                    {!! Form::text('end_time', null, ['class'=>'form-control', 'id'=>'id_end','placeholder'=>'yyyy-mm-dd HH:MM']) !!}
               </div>
           </div>
       </div>
       <div class="form-group mb-5">
           {!! Form::label('id_desc','Description') !!}
           {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'id_desc', 'row'=>5, 'cols'=>20]) !!}
        </div>
        <hr/>
        <div class="form-group form-inline">
            {!! Form::submit('Create Session',['class'=>'btn btn-primary mr-5','id'=>'submit']) !!}
            <a href="{{route('event.details')}}">Cancel</a>
        </div>

    {!! Form::close() !!}
</div>


@endsection
