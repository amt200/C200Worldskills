<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
  public function index($slug){
      $findEventBySlug = DB::table('events')->where('event_slug','=', $slug)->get();
      $event_id = $findEventBySlug[0]->id;
      $event_name = $findEventBySlug[0]->event_name;


    return view('CreateChannel', compact(['event_id','event_name','slug']));
  }

  public function store(Request $request, $slug){
      $validator = Validator::make($request->all(), [
          'channel_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/'
      ]);

      if ($validator->fails()) {
          return redirect('event/'.$slug.'/create_channel')
              ->withErrors($validator)
              ->withInput();
      }
      $channel = new Channel;

      $channel->channel_name = $request->channel_name;
      $channel->event_id = $request->event_id;

      $channel->save();


      return redirect('event/'.$slug);
  }
  public function update($slug, $id){

      $findEventBySlug = DB::table('events')->where('event_slug','=', $slug)->get();
      $event_name = $findEventBySlug[0]->event_name;

      $findChannelById = DB::table('channels')->where('id','=', $id)->get();
      $id = $findChannelById[0]->id;
      $channelData = [];

      $channelData['channel_name'] = $findChannelById[0]->channel_name;


      return view('UpdateChannel', compact(['channelData', 'event_name','slug','id']));

  }
  public function storeUpdate(Request $request, $slug){
      $validator = Validator::make($request->all(), [
          'channel_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/'
      ]);

      if ($validator->fails()) {
          return redirect('event/'.$slug.'/update_channel'.$request->id)
              ->withErrors($validator)
              ->withInput();
      }
      $id = $request->id;
      DB::table('channels')->where('id','=', $id)->update(['channel_name'=>$request->channel_name]);
      return redirect('event/'.$slug);
  }
  public function delete($slug, $id){
      $eventBySlug = DB::table('events')->where('event_slug', '=', $slug)->get();
      $eventId = $eventBySlug[0]->id;

      DB::table('sessions')->where([['channel_id','=', $id],['event_id','=',$eventId]])->delete();
      DB::table('rooms')->where([['channel_id','=', $id],['event_id','=',$eventId]])->delete();
      DB::table('channels')->where([['id','=', $id],['event_id','=',$eventId]])->delete();

      return redirect('event/'.$slug);
  }
}
