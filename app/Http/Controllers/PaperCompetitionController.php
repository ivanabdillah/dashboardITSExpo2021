<?php

namespace App\Http\Controllers;

use App\Actions\CompetitionRegister;
use Illuminate\Http\Request;

class PaperCompetitionController extends Controller
{
    public function registerPage(){
        return view('pages.events.main-events.paper-competition');
    }

    public function register(Request $request){
        $register_result=CompetitionRegister::execute($request,'paper');
        if($register_result['success']){
            return redirect(route('paper-competition.index'))->with(['status'=>'success']);
        }else{
            return redirect(route('paper-competition.index'))->with(['status'=>$register_result['message'],'message'=>$register_result['message']]);
        }
    }
}
