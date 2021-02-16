<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Role;
use App\Models\TeamMember;
use App\Models\TeamProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
class BCCController extends Controller
{
    function registerPage(){
        return view('pre-event.business-case-competition');
    }

    function register(Request $request){
        $request->validate([
            'nama_tim'=>'required|string',
            'nama_ketua'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed|min:8|max:12',
            'perguruan_tinggi'=>'required|string',
            'nomor_hp'=>['required','string','regex:/^(^08)\d{8,11}$/']
        ]);
        $bcc_id = Competition::where('name','bcc')->first()->id;
        $check_team = TeamProfile::where('competition_id',$bcc_id)->where('team_name',$request->nama_tim)->count()>0;
        
        if($check_team){
            return redirect(route('bcc.index'))->with(['status'=>'error','message'=>'Nama tim sudah dipakai']);    
        }

        $role_id = Role::where('name','peserta')->first()->id;
        $ketua_data = TeamMember::create(['name'=>$request->nama_ketua,'phone'=>$request->nomor_hp]);
        $team_profile_data = TeamProfile::create(['team_name'=>$request->nama_tim,'college_name'=>$request->perguruan_tinggi,'ketua_id'=>$ketua_data->id,'competition_id'=>$bcc_id]);

        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$role_id,
            'userable_id'=>$team_profile_data->id,
            'userable_type'=>'App\Models\TeamProfile'
        ]);
        event(new Registered($user));
        return redirect(route('bcc.index'))->with(['status'=>'success']);
    }
    // unggaah submisi

}
