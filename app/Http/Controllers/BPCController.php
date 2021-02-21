<?php

namespace App\Http\Controllers;

use App\Actions\CompetitionRegister;
use Illuminate\Http\Request;

class BPCController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.business-plan-competition');
    }

    public function register(Request $request){
        $register_result=CompetitionRegister::execute($request,'bpc');
        if($register_result['success']){
            return redirect(route('bpc.index'))->with(['status'=>'success']);
        }else{
            return redirect(route('bpc.index'))->with(['status'=>$register_result['message'],'message'=>$register_result['message']]);
        }
    }
}
