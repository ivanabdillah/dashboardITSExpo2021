<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.conference');
    }

    public function register(Request $request){

    }
}
