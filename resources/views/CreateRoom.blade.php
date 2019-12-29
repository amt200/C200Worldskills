@extends('layouts.master')

@section('content')
<div class="panel-heading">
    <h1>Worldskills Conference 2019</h1>
    <h5>August 23, 2019</h5>
</div>

<div class="panel-heading">
    <br>
    <h4>Create New Room</h4>
    <br>
    Name:<br>
    <input type="text" size="50" name="channel_name" value=" " required/>
    <br/>
    <br>
    Channel:<br>
    <select>
        <option value="channel_id" >Main</option>
        <option value="channel_id">idk</option>
    </select>
    <br>
    <Br>
    Capacity:<br>
    <input type="text" size="50" name="room_capacity" value=" " required/>
    <br/>
    <br>

</div>
<div>
    <br>
    <input type="submit" value="Save Room">
</div>


@endsection
