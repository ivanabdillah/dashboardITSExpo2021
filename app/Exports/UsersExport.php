<?php

namespace App\Exports;

use App\Models\TeamProfile;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function __construct($competition)
    {
        $this->competitionId = $competition['id'];
        $this->competitionName = $competition['name'];
    }

    public function view(): View
    {
        $users = TeamProfile::with(
            'user',
            'competition',
            'ketua',
            'anggotaPertama',
            'anggotaKedua',
            'invoice',
            'invoice.promo'
        )->where('competition_id', $this->competitionId)->get();

        // dd($users);

        return view('users.admin.exports', [
            'users' => $users,
            'competition' => $this->competitionName
        ]);
    }
}
