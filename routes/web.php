<?php


// Route::get('/dashboard',  'DashboardController@index')->name('dashboard');

// --------------- //
// Manage Events  //
// ------------- //
Route::get('/event',  'EventController@index')->name('event');
Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
	Route::get('/create', 'EventController@create')->name('create');
	Route::post('/create', 'EventController@create')->name('create');
	//Route::get('/overview', 'EventController@overview')->name('overview');

    // event slug
    Route::get('/{slug}', 'EventController@getSlug')->name('overview');

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
    Route::get('/home', 'AttendeeController@dashboard');
    Route::get('/list', 'AttendeeController@list');
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
Route::get('/login/organizer', 'Auth\LoginController@showOrganizerLoginForm');
Route::get('/login/attendee', 'Auth\LoginController@showAttendeeLoginForm');
// Route::get('/register/organizer', 'Auth\RegisterController@showOrganizerRegisterForm');
// Route::get('/register/blogger', 'Auth\RegisterController@showBloggerRegisterForm');

Route::post('/login/organizer', 'Auth\LoginController@organizerLogin');
Route::post('/login/attendee', 'Auth\LoginController@attendeeLogin');
// Route::post('/register/organizer', 'Auth\RegisterController@createAdmin');
// Route::post('/register/blogger', 'Auth\RegisterController@createBlogger');

Route::view('/dashboard', 'dashboard')->middleware('auth');
Route::view('/organizer', 'dashboard');
Route::view('/attendee', 'Attendee');