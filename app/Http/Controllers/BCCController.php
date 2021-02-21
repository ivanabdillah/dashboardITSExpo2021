<?php

namespace App\Http\Controllers;

use App\Actions\CompetitionRegister;
use Illuminate\Http\Request;
class BCCController extends Controller
{
    function registerPage(){
        return view('pages.events.pre-events.business-case-competition');
    }

    function register(Request $request){
        $register_result=CompetitionRegister::execute($request,'bcc');
        if($register_result['success']){
            return redirect(route('bcc.index'))->with(['status'=>'success']);
        }else{
            return redirect(route('bcc.index'))->with(['status'=>$register_result['message'],'message'=>$register_result['message']]);
        }
    }
    // unggaah submisi

}
