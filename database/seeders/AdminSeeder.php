<?php

namespace Database\Seeders;

use App\Models\InternalProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
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
                'id' => 2,
                'name' => 'admin paper competition',
                'division' => 'conference',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'admin bcc',
                'division' => 'bcc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'anggita bcc',
                'division' => 'bcc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'name' => 'admin bpc',
                'division' => 'bpc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'name' => 'hendra webapss',
                'division' => 'webapps',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('internal_profiles')->insert($internalProfiles);

        $email = [
            'akotransabi@gmail.com',
            'hofitsexpo2019@gmail.com',
            'Anggita179@gmail.com',
            'businessplanitsexpo@gmail.com',
            'akhmadsyafrie99@gmail.com',
        ];
        $i = 0;
        foreach ($internalProfiles as $profile) {
            User::create([
                'email' => $email[$i],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin_itsexpo'),
                'role_id' => 2,
                'userable_id' => $profile['id'],
                'userable_type' => \App\Models\InternalProfile::class,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            ++$i;
        }
//        $users = [
//            [
//                'id' => 111,
//                'email' => '',
//                'email_verified_at' => Carbon::now(),
//                'password' => Hash::make('password'),
//                'role_id' => 2,
//                'userable_id' => 1,
//                'userable_type' => InternalProfile::class,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ],
//        ];
    }
}
