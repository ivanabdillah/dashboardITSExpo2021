<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Throwable;

use App\Models\User;
use App\Models\Competition;


class UserController extends Controller
{
    // isi biodata anggota
    // ganti password

    public function passwordForm()
    {
        return view('users.password');
    }

    public function passwordUpdate(Request $request)
    {
        $passwords = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string',
            'confirm_password' => 'required|string'
        ]);

        if (Hash::check($passwords['old_password'], $request->user()->password)) {
            if ($passwords['new_password'] !== $passwords['confirm_password']) {
                return redirect()->route('pengguna.password.form')->withErrors('Konfirmasi password tidak benar');
            } else {
                try {
                    $request->user()->update([
                        'password' => Hash::make($passwords['new_password'])
                    ]);
                    return redirect()->route('pengguna.password.form')->with('success', 'Password berhasil diubah');
                } catch (Throwable $e) {
                    return redirect()->route('pengguna.password.form')->withErrors("Terjadi kesalahan : {$e->getMessage()}");
                }
            }
        } else {
            return redirect()->route('pengguna.password.form')->withErrors('Password lama tidak benar');
        }
    }

    public function biodataForm()
    {
        $biodata = User::with('userable.ketua', 'userable.anggotaPertama', 'userable.anggotaKedua', 'userable.competition')->where('id', Auth::user()->id)->firstOrFail();
        // return $biodata;
        return view('users.biodata')->with(['biodata' => $biodata]);
    }

    public function biodataUpdate(Request $request)
    {
        dd($request);
    }
}
