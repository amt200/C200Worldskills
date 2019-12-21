<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
  public function index(){
    return view('CreateSession');
  }
  public function store(){

  }

  public function update(){
    return view('UpdateSession');
  }

}
