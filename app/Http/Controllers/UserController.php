<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Auth;

class UserController extends Controller
{

    public function show(\App\User $user) {
        return view('pages.users.show', ['user'=>$user]);
    }
    public function showAllUserForm() {
        $users = \App\User::all();
        // TODO Improve the table layout
        return view('pages.users.showall', ['users'=>$users]);
    }

    public function showEditForm(\App\User $user) {
        return view('pages.users.edit', ['user'=>$user]);
    }
    public function edit(\App\User $user) {
        $user->forename = request()->input('forename');
        $user->surname = request()->input('surname');
        $user->email = request()->input('email');
        if(Gate::allows('change-password', $user)){
            if(!password_verify(request()->input('password'), $user->password)){
                if(request()->input('password') != request()->input('password_confirmation')){
                    return back()->withErrors(['message'=>'Password\'s don\'t match!']);
                }
                $user->password = request()->input('password');
            }
        }
        if(Gate::allows('admin-only', Auth::user())) {
            $user->admin = request()->input('admin');
            $user->validated = request()->input('validated');
        }
        $user->save();
        $user->departments()->sync(request()->input('departments'));
        return redirect('/users/'.$user->id.'/view');
    }

    public function showAllValidations(){
        $users = \App\User::where('validated', 0)->get();
        return view('pages.users.validate', ['users'=>$users]);
    }

    public function validateUser(\App\User $user) {
        $user->validated = 1;
        $user->save();
        return redirect('/users/validate');
    }

    public function delete(\App\User $user) {
        $user->delete();
        return redirect('/users');
    }
}
