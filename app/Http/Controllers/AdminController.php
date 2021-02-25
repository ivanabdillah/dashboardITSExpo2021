<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Promo;
use App\Models\TeamProfile;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        $competition = Competition::withCount('team')->get();
        return view('users.admin.home')->with([
            'user' => $request->user()->load('userable'),
            'competition' => $competition
        ]);
    }

    public function peserta($id)
    {
        $peserta = TeamProfile::with('user', 'ketua', 'anggotaPertama', 'anggotaKedua', 'competition', 'invoice.promo')->where('id', $id)->firstOrFail();
        return view('users.admin.detail')->with('peserta', $peserta);
    }

    public function promo()
    {
        $promo = Promo::withCount('invoice')->get();
        return view('users.admin.promo')->with('promos', $promo);
    }

    public function tambahPromo(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:App\Models\Promo,name',
            'discount' => 'required|integer|min:10',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);
        // $data['start'] = Carbon::createFromFormat('Y-m-d', $data['start'])->format('Y-m-d H:i:s');
        // $data['end'] = Carbon::createFromFormat('Y-m-d', $data['end'])->format('Y-m-d H:i:s');
        Promo::create($data);
        return redirect()->route('admin.promo')->with('success', 'Promo berhasil ditambahkan');
    }

    public function updatePromo(Request $request, $id)
    {
        $data = $request->validate([
            'id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);

        $promo = Promo::where('id', $id)->firstOrFail();
        $promo->update([
            'start' => $data['start'],
            'end' => $data['end']
        ]);

        return redirect()->route('admin.promo')->with('success', 'Promo berhasil diperbarui');
    }

    public function hapusPromo($id)
    {
        $promo = Promo::with('invoice')->where('id', $id)->firstOrFail();

        if (count($promo['invoice']) > 0) {
            return redirect()->route('admin.promo')->withErrors(['Promo telah dipakai, tidak dapat dihapus', 'Batasi penggunaan dengan mengatur tanggal']);
        } else {
            $promo->delete();
            return redirect()->route('admin.promo')->with('success', 'Promo berhasil dihapus');
        }
    }
}
