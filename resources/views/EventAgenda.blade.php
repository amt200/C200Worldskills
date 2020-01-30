@extends('layouts.master')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-6">
                <h2>{{$slug}}</h2>
            </div>
            <div class="col-6">
                {!! Form::open(['method'=>'POST','action'=>'AttendeeController@eventRegister']) !!}
                {!! Form::submit('Register for this event',['class'=>'btn btn-primary float-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            @foreach($formatted_timings as $timing)

               <th scope="col">{{$timing}}</th>

            @endforeach

        </tr>
        </thead>
        <tbody>
        @foreach($allData as $key=>$collection)
            {{$collection}}
            <tr>
                @foreach($collection as $data)

                    @if($key == 0)
                <td>{{$data->channel_name}}</td>
                    @endif

                    @if($key == 1)
                <td>{{$data->room_name}}</td>
                    @endif

                    @if($key == 2)
                <td>{{$data->title}}</td>
                    @endif

                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
