<?php

namespace App\Http\Controllers;

use App\Actions\ConferenceRegister;
use App\Models\BeasiswaFair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeasiswaFairController extends Controller
{
    function registerPage(){
        return view('pages.events.pre-events.beasiswa-fair');
    }

    function register(Request $request){
        $register_data = ConferenceRegister::execute($request,'beasiswa_fair');
        if($register_data['success']){
            return redirect(route('beasiswa-fair.index'))->with(['status'=>'success']);
        }
    }
}
