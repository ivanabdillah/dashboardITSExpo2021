<?php

namespace App\Http\Controllers;

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
        // dd($request);
        $request->validate([
            'nama'=>'required|string',
            'email'=>'required|email',
            'instansi'=>'required|string',
            'no_wa'=>['required','string','regex:/^(^08)\d{8,11}$/'],
            'file_follow'=>'required|image|mimes:jpg,gif,jpeg,png',
            'file_twibbon'=>'required|image|mimes:jpg,gif,jpeg,png',
            'file_story'=>'required|image|mimes:jpg,gif,jpeg,png'
        ]);
        $follow_name = $request->nama.Carbon::now()->format('Ymd His') .'.'. $request->file('file_follow')->getClientOriginalExtension();
        $twibbon_name = $request->nama.Carbon::now()->format('Ymd His') .'.'. $request->file('file_twibbon')->getClientOriginalExtension();
        $story_name = $request->nama.Carbon::now()->format('Ymd His') .'.'. $request->file('file_story')->getClientOriginalExtension();

        if (!Storage::disk('public')->exists('images/beasiswa_fair/follow')) {
            Storage::disk('public')->makeDirectory('images/beasiswa_fair/follow');
        }
        if (!Storage::disk('public')->exists('images/beasiswa_fair/twibbon')) {
            Storage::disk('public')->makeDirectory('images/beasiswa_fair/twibbon');
        }
        if (!Storage::disk('public')->exists('images/beasiswa_fair/story')) {
            Storage::disk('public')->makeDirectory('images/beasiswa_fair/story');
        }

        $request->file('file_twibbon')->storeAs('images/beasiswa_fair/twibbon',$twibbon_name,'public');
        $request->file('file_follow')->storeAs('images/beasiswa_fair/follow',$follow_name,'public');
        $request->file('file_story')->storeAs('images/beasiswa_fair/story',$story_name,'public');
        
        BeasiswaFair::create([
            'name'=>$request->nama,
            'email'=>$request->email,
            'instansi'=>$request->instansi,
            'phone'=>$request->no_wa,
            'twibbon_path'=>$twibbon_name,
            'instagram_path'=>$follow_name,
            'story_path'=>$story_name
        ]);

        return redirect(route('beasiswa-fair.index'))->with(['status'=>'success']);
    }
}
