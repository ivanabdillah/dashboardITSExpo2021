<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CompetiionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            'id' => 1,
            'name' => 'BCC',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
