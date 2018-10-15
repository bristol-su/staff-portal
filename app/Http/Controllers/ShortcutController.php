<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use DB;

class ShortcutController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /* Create */
    public function showCreateForm() {
        return view('pages.shortcuts.create', ['categories'=>$this->getCategories()]);
    }

    public function create() {

        if(request()->input('category') == 'create_new_category'){
            $category = request()->input('new_category');
        } else {
            $category = request()->input('category');
        }
        if($category == ""){
            return back()->withErrors(['message'=>'Category can\'t be empty']);
        }




        if(request()->input('privacy') == 'department'){
            $shortcut = new \App\DepartmentShortcut();
            $shortcut->category = $category;
            $shortcut->name = request()->input('name');
            $shortcut->link = request()->input('link');
            $shortcut->description = request()->input('description');
            $shortcut->save();
            \App\Department::findOrFail(request()->input('department'))->each(function($d) use (&$shortcut){
                $d->shortcuts()->attach($shortcut->id);
            });
        } elseif (request()->input('privacy') == 'private'){
            $shortcut = new \App\UserShortcut();
            $shortcut->category = $category;
            $shortcut->user_id = Auth::user()->id;
            $shortcut->name = request()->input('name');
            $shortcut->link = request()->input('link');
            $shortcut->description = request()->input('description');
            $shortcut->save();

        }

        return redirect('/');
    }

    /* Read */
    public function show(\App\UserShortcut $shortcut) {
        return view('pages.shortcuts.show')->with('shortcut', $shortcut);
    } //Show individual shortcut

    public function departmentshow(\App\DepartmentShortcut $shortcut) {
        return view('pages.shortcuts.departmentshow')->with('shortcut', $shortcut);
    }

    public function showAllShortcutForm() {
        $usershortcuts = Auth::user()->shortcuts->all();
        $departmentshortcuts = array();
        Auth::user()->departments()->get()->each(function($d) use (&$departmentshortcuts) {
            if(!isset($departmentshortcuts[$d->name])){
                $departmentshortcuts[$d->name] = array();
            }
            $departmentshortcuts[$d->name] = $d->shortcuts()->get();
        });
        return view('pages.shortcuts.showall', ['usershortcuts'=>$usershortcuts, 'departmentshortcuts'=>$departmentshortcuts]);
    }

    /* Update */
    public function showUserEditForm(\App\UserShortcut $shortcut) {
        abort_unless(Gate::allows('edit-shortcut', $shortcut), 403, 'This isn\'t your shortcut to edit!');
        return view('pages.shortcuts.edituser', ['shortcut'=>$shortcut, 'categories'=>$this->getCategories()]);
    }

    public function showDepartmentEditForm(\App\DepartmentShortcut $shortcut) {
        return view('pages.shortcuts.editdepartment', ['shortcut'=>$shortcut, 'categories'=>$this->getCategories()]);
    }

    public function edit(\App\UserShortcut $shortcut){

        // Determine if we're creating a new category or not
        if(request()->input('category') == 'create_new_category'){
            $category = request()->input('new_category');
        } else {
            $category = request()->input('category');
        }
        if($category == ""){
            return back()->withErrors(['message'=>'Category can\'t be empty']);
        }
        $shortcut->name = request()->input('name');
        $shortcut->link = request()->input('link');
        $shortcut->description = request()->input('description');
        $shortcut->category = $category;
        $shortcut->save();
        return redirect('/');
    }

    public function departmentedit(\App\DepartmentShortcut $shortcut) {
        // Determine if we're creating a new category or not
        if(request()->input('category') == 'create_new_category'){
            $category = request()->input('new_category');
        } else {
            $category = request()->input('category');
        }
        if($category == ""){
            return back()->withErrors(['message'=>'Category can\'t be empty']);
        }
        $shortcut->name = request()->input('name');
        $shortcut->link = request()->input('link');
        $shortcut->description = request()->input('description');
        $shortcut->category = $category;
        $shortcut->save();
        $departments = \App\Department::findOrFail(request()->input('department'))->pluck('id')->toArray();
        $shortcut->departments()->sync($departments);

        return redirect('/');
    }

    /* Delete */
    public function delete(\App\UserShortcut $shortcut) {
        $shortcut->delete();
        return back();
    }

    public function departmentdelete(\App\DepartmentShortcut $shortcut) {
        $shortcut->delete();
        return back();
    }


    public function getCategories() {
        /* User Categories */
        $categories = array();
        Auth::user()->shortcuts()->get(['category'])->each(function($category) use (&$categories) {
            $categories[] = $category["category"];
        });

        /* Department Categories */
        Auth::user()->departments()->get()->each(function($d) use (&$categories) {
            $categories = array_merge($categories, $d->shortcuts()->get(['category'])->pluck('category')->toArray());
        });
        return array_unique($categories);
    }

}
