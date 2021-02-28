<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\TeamProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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

    public function adminPasswordForm()
    {
        return view('users.admin.password');
    }

    public function adminPasswordUpdate(Request $request)
    {
        $passwords = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string',
            'confirm_password' => 'required|string'
        ]);

        if (Hash::check($passwords['old_password'], $request->user()->password)) {
            if ($passwords['new_password'] !== $passwords['confirm_password']) {
                return redirect()->route('admin.password.form')->withErrors('Konfirmasi password tidak benar');
            } else {
                try {
                    $request->user()->update([
                        'password' => Hash::make($passwords['new_password'])
                    ]);
                    return redirect()->route('admin.password.form')->with('success', 'Password berhasil diubah');
                } catch (Throwable $e) {
                    return redirect()->route('admin.password.form')->withErrors("Terjadi kesalahan : {$e->getMessage()}");
                }
            }
        } else {
            return redirect()->route('admin.password.form')->withErrors('Password lama tidak benar');
        }
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
        $teamProfile = TeamProfile::findOrFail(Auth::user()->userable_id);
        $ketua = TeamMember::findOrFail($teamProfile->ketua_id);
        if ($request->has('ketua.foto')) {
            $fotoName = $request->ketua['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('ketua.foto')->getClientOriginalExtension();
            $photoPath = 'images/bcc/foto/';
            Storage::putFileAs($photoPath, $request->file('ketua.foto'), $fotoName);
            $ketua->photo_path = $photoPath . $fotoName;
        }

        if ($request->has('ketua.ktm')) {
            $ktmName = $request->ketua['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('ketua.ktm')->getClientOriginalExtension();
            $ktmPath = 'images/bcc/ktm/';
            Storage::putFileAs($ktmPath, $request->file('ketua.ktm'), $ktmName);
            $ketua->ktm_path = $ktmPath . $ktmName;
        }

        $ketua->name = $request->ketua['nama'];
        $ketua->majors = $request->ketua['jurusan'];
        $ketua->year = $request->ketua['angkatan'];
        $ketua->phone = $request->ketua['phone'];
        $ketua->line = $request->ketua['line'];
        $ketua->save();

        if ($request->has('anggota_pertama')) {
            $anggota1 = TeamMember::findOrFail($teamProfile->anggota1_id);
            $anggota1->name = $request->anggota_pertama['nama'];
            $anggota1->majors = $request->anggota_pertama['jurusan'];
            $anggota1->year = $request->anggota_pertama['angkatan'];
            $anggota1->phone = $request->anggota_pertama['phone'];
            $anggota1->line = $request->anggota_pertama['line'];
            $anggota1->save();
        }

        if ($request->has('anggota_kedua')) {
            $anggota2 = TeamMember::findOrFail($teamProfile->anggota2_id);
            $anggota2->name = $request->anggota_kedua['nama'];
            $anggota2->majors = $request->anggota_kedua['jurusan'];
            $anggota2->year = $request->anggota_kedua['angkatan'];
            $anggota2->phone = $request->anggota_kedua['phone'];
            $anggota2->line = $request->anggota_kedua['line'];
            $anggota2->save();
        }

        if ($request->has('baru.anggota_pertama')) {
            if ($request->file('baru.anggota_pertama.foto')) {
                $fotoName = $request->baru['anggota_pertama']['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('baru.anggota_pertama.foto')->getClientOriginalExtension();
                $photoPath = 'images/bcc/foto/';
                Storage::putFileAs($photoPath, $request->file('baru.anggota_pertama.foto'), $fotoName);

                $ktmName = $request->baru['anggota_pertama']['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('baru.anggota_pertama.ktm')->getClientOriginalExtension();
                $ktmPath = 'images/bcc/ktm/';
                Storage::putFileAs($ktmPath, $request->file('baru.anggota_pertama.ktm'), $ktmName);
            } else {
                $photoPath = null;
                $fotoName = null;
                $ktmPath = null;
                $ktmName = null;
            }

            TeamMember::create([
                'name' => $request->baru['anggota_pertama']['nama'],
                'majors' => $request->baru['anggota_pertama']['jurusan'],
                'year' => $request->baru['anggota_pertama']['angkatan'],
                'photo_path' => $photoPath . $fotoName,
                'ktm_path' => $ktmPath . $ktmName,
                'phone' => $request->baru['anggota_pertama']['phone'],
                'line' => $request->baru['anggota_pertama']['line'],
            ]);

            $teamProfile->anggota1_id = TeamMember::orderBy('id', 'desc')->limit(1)->value('id');
            $teamProfile->save();
        }

        if ($request->has('baru.anggota_kedua')) {
            if ($request->file('baru.anggota_kedua.foto')) {
                $fotoName = $request->baru['anggota_kedua']['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('baru.anggota_kedua.foto')->getClientOriginalExtension();
                $photoPath = 'images/bcc/foto/';
                Storage::putFileAs($photoPath, $request->file('baru.anggota_kedua.foto'), $fotoName);

                $ktmName = $request->baru['anggota_kedua']['nama'] . Carbon::now()->format('Ymd His') . '.' . $request->file('baru.anggota_kedua.ktm')->getClientOriginalExtension();
                $ktmPath = 'images/bcc/ktm/';
                Storage::putFileAs($ktmPath, $request->file('baru.anggota_kedua.ktm'), $ktmName);
            } else {
                $photoPath = null;
                $fotoName = null;
                $ktmPath = null;
                $ktmName = null;
            }

            TeamMember::create([
                'name' => $request->baru['anggota_kedua']['nama'],
                'majors' => $request->baru['anggota_kedua']['jurusan'],
                'year' => $request->baru['anggota_kedua']['angkatan'],
                'photo_path' => $photoPath . $fotoName,
                'ktm_path' => $ktmPath  . $ktmName,
                'phone' => $request->baru['anggota_kedua']['phone'],
                'line' => $request->baru['anggota_kedua']['line'],
            ]);

            $teamProfile->anggota2_id = TeamMember::orderBy('id', 'desc')->limit(1)->value('id');
            $teamProfile->save();
        }

        return redirect()->route('pengguna.biodata.form')->with('success', 'data has been updated');
    }

    public function berkasBiodata(Request $request)
    {
        $request->validate([
            'berkas' => 'required'
        ]);

        $path = $request->berkas;

        if (File::isDirectory(storage_path('app/' . $path))) {
            return Storage::disk('local')->response(Storage::disk('local')->files($path)[0]);
        } else if (File::isFile(storage_path('app/' . $path))) {
            return Storage::disk('local')->response($path);
        }

        return redirect()->back()->withErrors('Berkas tidak ditemukan');
    }
}
