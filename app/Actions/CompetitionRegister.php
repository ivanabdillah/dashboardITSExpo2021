<?php
namespace App\Actions;

use App\Models\Competition;
use App\Models\Role;
use App\Models\Submission;
use App\Models\TeamMember;
use App\Models\TeamProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompetitionRegister{
    public static function execute(Request $request,$competition){
        $request->validate([
            'nama_tim'=>'required|string',
            'nama_ketua'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed|min:8|max:12',
            'perguruan_tinggi'=>'required|string',
            'jurusan'=>'required|string',
            'tahun_angkatan'=>'required|numeric|min:0|max:'.date('Y'),
            'nomor_hp'=>['required','string','regex:/^(^08)\d{8,11}$/']
        ]);
        if($competition=='bpc'){
            $request->validate([
                'file_twibbon'=>'required|image|mimes:jpg,gif,jpeg,png'
            ]);
        }
        $bcc_id = Competition::where('name',$competition)->first()->id;
        $check_team = TeamProfile::where('competition_id',$bcc_id)->where('team_name',$request->nama_tim)->count()>0;
        
        if($check_team){
            return ['success'=>false,'status'=>'error','message'=>'Nama tim sudah dipakai'];
        }

        $role_id = Role::where('name','peserta')->first()->id;
        $ketua_data = TeamMember::create(
            [
                'name'=>$request->nama_ketua,
                'phone'=>$request->nomor_hp,
                'majors'=>$request->jurusan,
                'year'=>$request->tahun_angkatan
            ]
        );
        $team_profile_data = TeamProfile::create(
            [
                'team_name'=>$request->nama_tim,
                'college_name'=>$request->perguruan_tinggi,
                'ketua_id'=>$ketua_data->id,
                'competition_id'=>$bcc_id
            ]
        );
        if($competition=='bpc'){
            $twibbon_name = $request->nama.Carbon::now()->format('Ymd His') .'.'. $request->file('file_twibbon')->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/bpc/twibbon')) {
                Storage::disk('public')->makeDirectory('images/bpc/twibbon');
            }
            $request->file('file_twibbon')->storeAs('images/beasiswa_fair/twibbon',$twibbon_name,'public');
            Submission::create(
                [
                    'name'=>'Twibbon',
                    'description'=>'twibbon bpc '.$request->nama_tim,
                    'path'=>'images/beasiswa_fair/twibbon'.$twibbon_name,
                    'team_id'=>$team_profile_data->id
                ]
            );
        }
        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$role_id,
            'userable_id'=>$team_profile_data->id,
            'userable_type'=>'App\Models\TeamProfile'
        ]);
        event(new Registered($user));
        return ['success'=>true];
    }
}
?>