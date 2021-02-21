<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $internalProfiles = [
            [
                'id' => 1,
                'name' => 'Admin nich',
                'division' => 'hahahihi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('internal_profiles')->insert($internalProfiles);

        $ketua = [
            [
                'id' => 1,
                'name' => 'Ketua amanah',
                'majors' => 'Sistem Informasi',
                'year' => 2018,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('team_members')->insert($ketua);

        $teams = [
            [
                'id' => 1,
                'team_name' => 'Um',
                'college_name' => 'Universitas Brawijaya',
                'ketua_id' => 1,
                'competition_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('team_profiles')->insert($teams);

        $users = [
            [
                'id' => 1,
                'email' => 'admin@localhost',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role_id' => 2,
                'userable_id' => 1,
                'userable_type' => \App\Models\InternalProfile::class,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'email' => 'ketua@localhost',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role_id' => 1,
                'userable_id' => 1,
                'userable_type' => \App\Models\TeamProfile::class,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('users')->insert($users);
    }
}
