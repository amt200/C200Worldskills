<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Channel;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{

    public function index($slug){
        $findEventBySlug = DB::table('events')->where('event_slug','=', $slug)->get();
        $event_id = $findEventBySlug[0]->id;
        $event_name = $findEventBySlug[0]->event_name;
    }

    public function create($slug){
        $event = Event::where('event_slug', '=', $slug)->first();

        $channel_names = [];
        $findEventBySlug = DB::table('events')->where('event_slug','=', $slug)->get();

        $channel_records = DB::table('channels')->where('event_id', '=', $findEventBySlug[0]->id)->get();

        foreach ($channel_records as $channel){
            $value = $channel->channel_name;
            $key = $channel->id;
            $channel_names[$key] = $value;
        }

        return view('CreateRoom', compact(['channel_names','findEventBySlug','slug','event']));
    }
    public function store(Request $request, $slug){
        $validator = Validator::make($request->all(), [
            'room_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
            'room_capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('event/'.$slug.'/create_room')
                ->withErrors($validator)
                ->withInput();
        }
        $room = new room;

        $room->room_name = $request->room_name;
        $room->channel_id = $request->channel;
        $room->event_id = $request->event_id;
        $room->room_capacity = $request->room_capacity;

        $room->save();
        return redirect('event/'.$slug);
    }

    public function edit($slug, $id)
    {
        $event = DB::table('events')->where('event_slug','=', $slug)->get();
        $room = DB::table('rooms')->where('id','=', $id)->get();
        $channel = DB::table('channels')->where('event_id','=', $event[0]->id)->get();
        $room_data = [];
        $channel_data = [];

        foreach ($channel as $c){
            $value = $c->channel_name;
            $key = $c->id;
            $channel_data[$key] = $value;
        }

        $room_data['room_name'] = $room[0]->room_name;
        $room_data['channel_id'] = $room[0]->channel_id;
        $room_data['room_capacity'] = $room[0]->room_capacity;

        return view('UpdateRoom', compact(['room_data','channel_data', 'event', 'slug', 'id']));
    }

    public function update(Request $request, $slug) {
        $validator = Validator::make($request->all(), [
            'room_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/',
            'room_capacity' => 'required'
        ]);


        if ($validator->fails()) {
            return redirect('event/'.$slug.'/update_room/'.$request->id)
                ->withErrors($validator)
                ->withInput();

        }

        $id = $request->id;
        DB::table('rooms')->where('id','=', $id)->update(['room_name'=>$request->room_name, 'channel_id'=>$request->channel, 'room_capacity'=>$request->room_capacity]);

        return redirect('event/'.$slug);
    }

    public function delete($slug, $id) {
        // get slug
        $eventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
        $eventId = $eventBySlug[0]->id;
        DB::table('sessions')->where([['room_id','=', $id],['event_id','=', $eventId]])->delete();
        DB::table('rooms')->where([['id','=', $id],['event_id','=', $eventId]])->delete();

        return redirect('event/'.$slug);
    }

}
