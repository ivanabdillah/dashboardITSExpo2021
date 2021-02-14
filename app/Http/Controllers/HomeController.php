<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user()->load('role');
        $user = User::findOrFail(Auth::id());
        if ($user['role']['id'] == 2 or $user['role']['name'] === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user['role']['id'] == 1 or $user['role']['name'] === 'peserta') {
            return redirect()->route('pengguna.biodata.form');
        }
    }
}
