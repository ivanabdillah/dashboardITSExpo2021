<?php

namespace App\Actions;

use App\Models\BeasiswaFair;
use App\Models\Conference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConferenceRegister
{
    public static function execute(Request $request, $conference_type)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'instansi' => 'required|string',
            'no_wa' => ['required', 'string', 'regex:/^(^08)\d{8,11}$/'],
            'file_follow' => 'required|image|mimes:jpg,gif,jpeg,png',
            'file_twibbon' => 'required|image|mimes:jpg,gif,jpeg,png',
            'file_story' => 'required|image|mimes:jpg,gif,jpeg,png'
        ]);
        if($conference_type=='conference'){
            $request->validate([
                'file_bukti_pembayaran' => 'required|image|mimes:jpg,gif,jpeg,png'
            ]); 

            $bukti_bayar_name = $request->nama . Carbon::now()->format('Ymd His') . '.' . $request->file('file_bukti_pembayaran')->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/' . $conference_type . '/bukti_bayar')) {
                Storage::disk('public')->makeDirectory('images/' . $conference_type . '/bukti_bayar');
            }
            $request->file('file_bukti_pembayaran')->storeAs('images/' . $conference_type . '/bukti_bayar', $bukti_bayar_name, 'public');
        }
        $follow_name = $request->nama . Carbon::now()->format('Ymd His') . '.' . $request->file('file_follow')->getClientOriginalExtension();
        $twibbon_name = $request->nama . Carbon::now()->format('Ymd His') . '.' . $request->file('file_twibbon')->getClientOriginalExtension();
        $story_name = $request->nama . Carbon::now()->format('Ymd His') . '.' . $request->file('file_story')->getClientOriginalExtension();

        if (!Storage::disk('public')->exists('images/' . $conference_type . '/follow')) {
            Storage::disk('public')->makeDirectory('images/' . $conference_type . '/follow');
        }
        if (!Storage::disk('public')->exists('images/' . $conference_type . '/twibbon')) {
            Storage::disk('public')->makeDirectory('images/' . $conference_type . '/twibbon');
        }
        if (!Storage::disk('public')->exists('images/' . $conference_type . '/story')) {
            Storage::disk('public')->makeDirectory('images/' . $conference_type . '/story');
        }

        $request->file('file_twibbon')->storeAs('images/' . $conference_type . '/twibbon', $twibbon_name, 'public');
        $request->file('file_follow')->storeAs('images/' . $conference_type . '/follow', $follow_name, 'public');
        $request->file('file_story')->storeAs('images/' . $conference_type . '/story', $story_name, 'public');

        if ($conference_type == 'beasiswa_fair') {
            BeasiswaFair::create([
                'name' => $request->nama,
                'email' => $request->email,
                'instansi' => $request->instansi,
                'phone' => $request->no_wa,
                'twibbon_path' => $twibbon_name,
                'instagram_path' => $follow_name,
                'story_path' => $story_name
            ]);
        }
        elseif($conference_type=='conference'){
            Conference::create([
                'name' => $request->nama,
                'email' => $request->email,
                'instansi' => $request->instansi,
                'phone' => $request->no_wa,
                'twibbon_path' => $twibbon_name,
                'instagram_path' => $follow_name,
                'story_path' => $story_name,
                'payment_proof'=>$bukti_bayar_name
            ]);
        }
        return ['success' => true];
    }
}
