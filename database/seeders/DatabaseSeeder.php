<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            CompetitionSeeder::class,
            AdminSeeder::class,
//            BCCSeeder::class,
            PaperSeeder::class,
//            DummyUserSeeder::class // comment di production
        ]);
    }
}
