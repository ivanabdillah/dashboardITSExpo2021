<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VirtualArtExhibitionController extends Controller
{
    function registerPage(){
        return view('pages.events.main-events.virtual-art-exhibition');
    }

    public function register(Request $request){

    }
}
