<?php

namespace App\Http\Controllers;

use App\Mail\AnnouncementPublished;
use App\Models\Announcement;
use App\Models\Competition;
use App\Models\Promo;
use App\Models\Submission;
use App\Models\TeamProfile;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
        $submission = Submission::where('team_id', $id)->where('name', 'Twibbon')->first();
        return view('users.admin.detail')->with([
            'peserta' => $peserta,
            'submission' => $submission
        ]);
    }

    public function pesertaExport($id)
    {
        $competition = Competition::where('id', $id)->firstOrFail();

        return Excel::download(new UsersExport($competition), "peserta_{$competition->name}.xlsx");
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

    public function indexAnnouncement()
    {
        $announcements = Announcement::with('competition')->orderBy('created_at', 'DESC')->get();
        $competition = Competition::get();
        return view('users.admin.announcement')->with(['announcements' => $announcements, 'competitions' => $competition]);
    }

    public function tambahAnnouncement(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'competition_id' => 'nullable|exists:competitions,id'
        ]);
        Announcement::create($data);

        $mailingList = [];
        if ($data['competition_id']) {
            $teams = TeamProfile::where('competition_id', $data['competition_id'])->with('user')->get();
            foreach ($teams as $team) {
                array_push($mailingList, $team['user']['email']);
            }
        } else {
            $users = User::select('email')->where('userable_type', 'App\Models\TeamProfile')->get();
            foreach ($users as $user) {
                array_push($mailingList, $user['email']);
            }
        }
        try {
            foreach ($mailingList as $recipient) {
                Mail::to($recipient)->send(new AnnouncementPublished($data));
            }
        } catch (Throwable $e) {
        }

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman dipublikasikan');
    }

    public function hapusAnnouncement($id)
    {
        $announcement = Announcement::where('id', $id)->firstOrFail();
        $announcement->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman dihapus');
    }
}
