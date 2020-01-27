<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
  public function index()
  {
    return view('CreateChannel');
  }

  public function store(Request $request, $slug){
      $validator = Validator::make($request->all(), [
          'channel_name'=>'required|regex:/^[A-Z][A-Za-z\s]*$/'
      ]);

      if ($validator->fails()) {
          return redirect('event/create_channel')
              ->withErrors($validator)
              ->withInput();
      }
      $channel = new Channel;

      $channel->channel_name = $request->channel_name;

      $channel->save();

      $event = Event::where('event_slug', '=', $slug)->first();
      
      return redirect('event/{$slug}');
  }
}
