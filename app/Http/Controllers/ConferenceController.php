<?php

namespace App\Http\Controllers;

use App\Actions\ConferenceRegister;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.conference');
    }

    function register(Request $request){
        $register_data = ConferenceRegister::execute($request,'conference');
        if($register_data['success']){
            return redirect(route('conference.index'))->with(['status'=>'success']);
        }
    }
}
