<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PortalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getShortcuts() {
        return view('pages.portal', [
            'all_shortcuts'=>$this->getShortcutsArray()
        ]);
    }


    private function getShortcutsArray() {

        // Get all User defined shortcuts
        $shortcuts = array();
        Auth::user()->shortcuts()->each(function($shortcut) use (&$shortcuts){
            if(!isset($shortcuts[$shortcut->category])){
                $shortcuts[$shortcut->category] = array();
            }
            $shortcuts[$shortcut->category][] = $shortcut;
        });

        /* Department Categories */
        Auth::user()->departments()->get()->each(function($d) use (&$shortcuts){
            $d->shortcuts()->each(function($shortcut) use (&$shortcuts) {
                if(!isset($shortcuts[$shortcut->category])){
                    $shortcuts[$shortcut->category] = array();
                }
                $shortcuts[$shortcut->category][] = $shortcut;
            });
        });
        return $shortcuts;
        // Get all
    }
}
