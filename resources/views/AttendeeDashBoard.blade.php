@extends('layouts.attendeeApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Event List') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                                @foreach($data as $i)
                                    {{$i->event_name}}
                                    {{$i->event_date}}<br>
                                @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
