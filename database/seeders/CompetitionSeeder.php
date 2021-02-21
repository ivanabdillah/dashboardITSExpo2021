<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            ['name' => 'bcc', 'price' => 175000],
            ['name' => 'bpc', 'price' => 250000],
            ['name' => 'paper', 'price' => 200000],
        ]);
    }
}
