<?php


Route::get('/dashboard',  'DashboardController@index')->name('dashboard');

// --------------- //
// Manage Events  //
// ------------- //
Route::get('/event',  'EventController@index')->name('event');
Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
	Route::get('/create', 'EventController@create')->name('create');
	Route::post('/create', 'EventController@create')->name('create');
	Route::get('/details', 'EventController@details')->name('details');

	Route::get('/create_session', 'SessionController@index')->name('create_session');
    Route::get('/update_session', 'SessionController@update')->name('update_session');
    Route::post('/store_session', 'SessionController@store')->name('store_session');
    Route::post('/store_channel', 'ChannelController@store')->name('store_channel');
	Route::get('/create_channel', 'ChannelController@index')->name('create_channel');
    Route::post('/store_channel', 'ChannelController@store')->name('store_channel');
	Route::get('/room_capacity', 'RoomController@index')->name('room_capacity');
	Route::get('/create_room', 'RoomController@create')->name('create_room');
    Route::post('/store_room', 'RoomController@store')->name('store_room');
});

// --------------- //
// Manage Ticket  //
// ------------- //
Route::get('/ticket',  'TicketController@index')->name('ticket');
Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
    Route::get('/create', 'TicketController@create')->name('create');
});

// --------------- //
// Manage session //
// ------------- //


// --------------- //
// Manage channel //
// ------------- //

Route::get('/create_room', function () {
    return view('CreateRoom');
});
Route::get('/room_capacity', function () {
    return view('RoomCapacity');
});


//ATTENDEE
Route::get('/attendee',  'AttendeeController@index')->name('attendee');
Route::group(['prefix' => 'attendee', 'as' => 'attendee.'], function () {
    Route::get('/event_register', 'AttendeeController@eventRegister')->name('event_register');
    Route::get('/home', 'AttendeeController@dashboard', function (){
        $event = events::findOrFail(1);
        foreach ($event->posts as $post){
            echo $post->event_name . "<br>";
        }
    });
});

//ATTENDEE SIGN IN
Route::get('/sign_in', function() {
    return view('sign_in');
});

//ATTENDEE SESSION DETAILS
Route::get('/attendee',  'AttendeeController@index')->name('attendee');
Route::group(['prefix' => 'attendee', 'as' => 'attendee.'], function () {
    Route::get('/session_details', 'AttendeeController@sessionDetails')->name('session_details');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

