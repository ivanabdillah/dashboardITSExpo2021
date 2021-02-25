<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class PesertaController extends Controller
{
    public function indexAnnouncement()
    {
        $user = Auth::user()->load('userable');
        $announcements = Announcement::with('competition')->whereNull('competition_id')->orWhere('competition_id', $user['userable']['competition_id'])->orderBy('created_at', 'DESC')->get();

        return view('users.announcement')->with('announcements', $announcements);
    }
}
