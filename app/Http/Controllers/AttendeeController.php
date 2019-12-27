<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index()
    {

    }

    public function eventRegister()
    {
        return view('AttendeeEventRegistration');
    }
}
