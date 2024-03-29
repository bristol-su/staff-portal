<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function showCreateForm() {
        return view('pages.departments.create');
    }
    public function create() {
        $department = new \App\Department();
        $department->name = request()->input('name');
        $department->save();

        return redirect('/departments');
    }

    public function show(\App\Department $department) {
        // TODO Show all users here
        // TODO Give a link to add users/Edit the department
        return view('pages.departments.show', ['department'=>$department]);
    }
    public function showAllDepartmentForm() {
        $departments = \App\Department::all();
        return view('pages.departments.showall', ['departments'=>$departments]);
    }

    public function showEditForm(\App\Department $department) {
        return view('pages.departments.edit', ['department'=>$department]);
    }
    public function edit(\App\Department $department) {
        $department->name = request()->input('name');
        $department->save();
        return redirect('/departments');
    }

    public function delete(\App\Department $department) {
        $department->delete();
        return redirect('/departments');
    }

    public function showUpdateUsersForm(\App\Department $department) {
        $users_ids = $department->users()->pluck('users.id')->toArray();
        $users = \App\User::all()->reject(function($user) use ($users_ids){
            return in_array($user->id, $users_ids);
        });
        return view('pages.departments.updateusers', ['department'=>$department, 'users'=>$users]);
    }

    public function updateUsers(\App\Department $department) {
        $department->users()->attach(request()->input('user'));
        return redirect('departments/'.$department->id.'/users');
    }

    public function deleteUser(\App\Department $department, \App\User $user) {
        $department->users()->detach($user);
        return back();
    }
}
