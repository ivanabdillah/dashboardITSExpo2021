<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaperCompetitionController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.paper-competition');
    }

    public function register(Request $request){

    }
}
