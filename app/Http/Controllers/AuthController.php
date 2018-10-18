<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // Show Forms
    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    //Register a User

    public function createUser() {
        // Validate the request

        $this->validate(request(), [
            'forename'=>'required',
            'surname'=>'required',
            'email'=>'required|email',
            'password'=>'min:6|confirmed'
        ]);

        // Create the user
        $user = \App\User::create(request([
            'forename',
            'surname',
            'email',
            'password'
        ]));
        event(new \App\Events\UserCreated($user));

        // Redirect the User
        return redirect('/login');
    }



    public function login(Request $request) {

        // Check if user valid
        //If not, error of NO ACCOUNT FOUND
        //If so, try and login
        //If not, their account isn't validated
        //If so, redirect to home
        if(!Auth::validate($request->only('email', 'password'))){
            return back()->withErrors([
                'message' => 'Your account wasn\'t found'
            ]);
        }
        if(!Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            "validated"=>1
        ], $request->has('remember'))){
            return back()->withErrors([
                'message' => 'Your account hasn\'t been validated yet'
            ]);
        } else {
            $request->session()->regenerate();
            return redirect('/');
        }

    }


    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
