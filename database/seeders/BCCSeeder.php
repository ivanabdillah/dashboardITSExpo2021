<?php

namespace Database\Seeders;

use App\Actions\GenerateDataframe;
use App\Models\TeamProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BCCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = GenerateDataframe::execute('database/dataset/BCC.csv');

        foreach ($data as $row) {
            $idKetua = DB::table('team_members')->insertGetId([
                'name' => $row['ketua_name'],
                'photo_path' => null,
                'majors' => 'unknown',
                'year' => 0,
                'ktm_path' => null,
                'phone' => $row['ketua_phone'],
                'line' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $idAnggota1 = DB::table('team_members')->insertGetId([
                'name' => $row['anggota1_name'],
                'photo_path' => null,
                'majors' => 'unknown',
                'year' => 0,
                'ktm_path' => null,
                'phone' => null,
                'line' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $idAnggota2 = null;
            if ($row['anggota2_name'] != '') {
                $idAnggota2 = DB::table('team_members')->insertGetId([
                    'name' => $row['anggota2_name'],
                    'photo_path' => null,
                    'majors' => 'unknown',
                    'year' => 0,
                    'ktm_path' => null,
                    'phone' => null,
                    'line' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $idTeam = DB::table('team_profiles')->insertGetId([
                'team_name' => $row['team_name'],
                'college_name' => $row['college_name'],
                'ketua_id' => $idKetua,
                'anggota1_id' => $idAnggota1,
                'anggota2_id' => $idAnggota2,
                'competition_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('users')->insert([
                'email' => $row['email'],
                'email_verified_at' => now(),
                'password' => Hash::make($row['email']),
                'role_id' => 1,
                'userable_id' => $idTeam,
                'userable_type' => TeamProfile::class,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('invoices')->insert([
                'team_id' => $idTeam,
                'payment_timestamp' => now(),
                'payment_proof' => null,
                'approver_id' => 4,
                'approved_at' => now(),
                'promo_id' => null
            ]);
        }


    }
}
