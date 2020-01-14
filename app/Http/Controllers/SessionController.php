<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Session_type;
use App\Session;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use App\Room;
use App\Channel;

class SessionController extends Controller
{
    public function index(){
        $types = [];

        $session_type = Session_type::all();

        foreach ($session_type as $type){
            $value = $type->type;
            $key = $type->id;
            $types[$key] = $value;
        }

        $channels = [];

        $channel_records = Channel::all();
        foreach ($channel_records as $channel){
            $value = $channel->channel_name;
            $key = $channel->id;
            $channels[$key] = $value;
        }

        foreach ($session_type as $type){
            $value = $type->type;
            $key = $type->id;
            $types[$key] = $value;
        }


        $room_names = [];

        $room_records = Room::all();

        foreach ($room_records as $room){
            $value = $room->room_name;
            $key = $room->id;
            $room_names[$key] = $value;
        }

        return view('CreateSession', compact(['types','room_names','channels']));
    }

    public function store(Request $request){

        $previousEndTime = new DateTime('now');


        if (Session::all()->last() != null){
            $previousEndTime = Session::all()->last()->end_time;
        }

        $validator = Validator::make($request->all(), [
            'title'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
            'speaker'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
            'cost'=>'required|regex:/^[0-9]+[.]{0,1}[0-9]+$/',
            'start_time'=>'required|regex:/^[0-9]{4}[-][0-1][0-9][-][0-3][0-9][ ][0-2][0-9][:][0-5][0-9]$/|after_or_equal:'.$previousEndTime,
            'end_time'=>'required|regex:/^[0-9]{4}[-][0-1][0-9][-][0-3][0-9][ ][0-2][0-9][:][0-5][0-9]$/',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('event/create_session')
                ->withErrors($validator)
                ->withInput();
        }

        $session = new Session;
        $start_time = new DateTime($request->start_time);
        $end_time = new DateTime($request->end_time);
        $session->event_id = 1;
        $session->room_id = 1;
        $session->session_type_id = $request->type;
        $session->title = $request->title;
        $session->speaker = $request->speaker;
        $session->description = $request->description;
        $session->start_time = $start_time;
        $session->end_time = $end_time;

        $session->save();

        return redirect('event/details');
    }

    public function update(){
        return view('UpdateSession');
    }

}
