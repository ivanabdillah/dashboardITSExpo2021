<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
//        dd($request);
        if ($request->has('baru.anggota_pertama')) {
            $fotoName = $request->baru['anggota_pertama']['nama'].Carbon::now()->format('Ymd His') .'.'. $request->file('baru.anggota_pertama.foto')->getClientOriginalExtension();
            $photoPath = 'images/bcc/foto/' . $fotoName;
            Storage::put($photoPath, $request->file('baru.anggota_pertama.foto'));

            $ktmName = $request->baru['anggota_pertama']['nama'].Carbon::now()->format('Ymd His') .'.'. $request->file('baru.anggota_pertama.ktm')->getClientOriginalExtension();
            $ktmPath = 'images/bcc/ktm/' . $ktmName;
            Storage::put($ktmPath, $request->file('baru.anggota_pertama.ktm'));

            TeamMember::create([
                'name' => $request->baru['anggota_pertama']['nama'],
                'photo_path' => $photoPath,
                'ktm_path' => $ktmPath,
                'phone' => $request->baru['anggota_pertama']['phone'],
                'line' => $request->baru['anggota_pertama']['line'],
            ]);
        }

        if ($request->has('baru.anggota_kedua')) {
            $fotoName = $request->baru['anggota_kedua']['nama'].Carbon::now()->format('Ymd His') .'.'. $request->file('baru.anggota_pertama.foto')->getClientOriginalExtension();
            $photoPath = 'images/bcc/foto/' . $fotoName;
            Storage::put($photoPath, $request->file('baru.anggota_kedua.foto'));

            $ktmName = $request->baru['anggota_kedua']['nama'].Carbon::now()->format('Ymd His') .'.'. $request->file('baru.anggota_pertama.ktm')->getClientOriginalExtension();
            $ktmPath = 'images/bcc/ktm/' . $ktmName;
            Storage::put($ktmPath, $request->file('baru.anggota_kedua.ktm'));

            TeamMember::create([
                'name' => $request->baru['anggota_kedua']['nama'],
                'photo_path' => $photoPath,
                'ktm_path' => $ktmPath,
                'phone' => $request->baru['anggota_kedua']['phone'],
                'line' => $request->baru['anggota_kedua']['line'],
            ]);
        }

        return redirect()->route('pengguna.biodata.form')->with('success', 'data has been updated');
    }
}
