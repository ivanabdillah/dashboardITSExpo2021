<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPCController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.business-plan-competition');
    }

    public function register(Request $request){

    }
}
