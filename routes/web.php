<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/manage_event', function () {
    return view('ManageEvent');
});
Route::get('/manage_event/create_event', function () {
    return view('CreateEvent');
});
Route::get('/manage_event/event_details', function () {
    return view('EventDetail');
});
Route::get('/create_ticket', function () {
    return view('CreateTicket');
});
Route::get('/create_channel', function () {
    return view('CreateChannel');
});
Route::get('/create_session', function () {
    return view('CreateSession');
});
Route::get('/create_room', function () {
    return view('CreateRoom');
});
Route::get('/room_capacity', function () {
    return view('RoomCapacity');
});

Route::get('/home', 'HomeController@index')->name('home');
