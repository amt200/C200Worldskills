@extends('layouts.master')

@section('content')
<div class="panel-heading">
    <h2 class="mt-3 mb-3">WorldSkills Conference 2019</h2>
    <hr/>
    <h4 class="mt-3 mb-5">Create Session</h4>

    <form method = "post" action="/session/store">

        <div class="form-group row">
            <div class="col-4">
                <label for="id_type">Type</label>
                <select class="form-control" id="id_type" name="type">
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                <label for="id_title">Title</label>
                <input type="text" class="form-control" id="id_title" name="title">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                <label for="id_speaker">Speaker</label>
                <input type="text" class="form-control" id="id_speaker" name="speaker">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                <label for="id_room">Room</label>
                <input type="text" class="form-control" id="id_room" name="room">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                <label for="id_cost">Cost</label>
                <input type="text" class="form-control" id="id_cost" name="cost">
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="id_start">Start</label>
                    <input type="text" class="form-control" id="id_start" name="start_time">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="id_end">End</label>
                    <input type="text" class="form-control" id="id_end" name="end_time">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <label for="id_description">Description</label>
            <textarea id="id_description" class="form-control" name="description" rows="5" cols="20"></textarea>
        </div>
        <hr/>
        <div class="form-group form-inline">
            <button type="submit" class="btn btn-primary mr-5">Create Session</button>
            <a href="{{route('event.details')}}">Cancel</a>
        </div>
    </form>
</div>


@endsection
