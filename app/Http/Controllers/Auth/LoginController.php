<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/event';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function showOrganizerLoginForm()
    {
        return view('auth.login', ['url' => 'organizer']);
    }

    public function organizerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $valid = Auth::guard('organizer')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($valid) {
            return Redirect::to('/event');
            // Auth::guard('organizer')->user();
            // 
            // return redirect(route('event'))->with(['error' => 'No permission']);
        }


        // If login fails
        return back()->with(['error' => 'No permission']);
    }

    public function showAttendeeLoginForm()
    {
        return view('auth.login', ['url' => 'attendee']);
    }

    public function attendeeLogin(Request $request)
    {
        $this->validate($request, [
            'lastName'   => 'required',
            'token' => 'required'
        ]);

        if (Auth::guard('attendee')->attempt(['lastName' => $request->lastName, 'token' => $request->token], $request->get('remember'))) {

            return redirect()->intended('/attendee');
        }
        return back()->withInput($request->only('lastName', 'remember'));
    }
}
