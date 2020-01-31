<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Channel;
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
        $channel_names = [];
        $findEventBySlug = DB::table('events')->where('event_slug','=', $slug)->get();

        $channel_records = DB::table('channels')->where('event_id', '=', $findEventBySlug[0]->id)->get();

        foreach ($channel_records as $channel){
            $value = $channel->channel_name;
            $key = $channel->id;
            $channel_names[$key] = $value;
        }

        return view('CreateRoom', compact(['channel_names','findEventBySlug','slug']));
    }
    public function store(Request $request, $slug){
        $validator = Validator::make($request->all(), [
            'room_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/'
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

        $findEventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
        $event_name = $findEventBySlug[0]->event_name;

        $findChannelById = DB::table('channels')->where('id', '=', $id)->get();
        $id = $findChannelById[0]->id;
        $channelData = [];

        $channelData['channel_name'] = $findChannelById[0]->channel_name;


        return view('UpdateChannel', compact(['channelData', 'event_name', 'slug', 'id']));
    }

    public function update(Request $request, $slug) {
        $request->validate([
            'room_name' => 'required',
            'room_capacity' => 'required'
        ]);

        if ($request->fails()) {
            return redirect('event/'.$slug.'/update_room'.$request->id)
                ->withErrors($request)
                ->withInput();

        }

        $id = $request->id;
        DB::table('rooms')->where('id','=', $id)->update(['room_name'=>$request->room_name]);
        DB::table('rooms')->where('id','=', $id)->update(['room_capacity'=>$request->room_capacity]);
        return redirect('event/'.$slug);
    }

    public function delete($slug) {
        // get slug
        $room = Room::where('event_slug', '=', $slug)->first();
        $room->delete();

        return redirect('/event');
    }

}
