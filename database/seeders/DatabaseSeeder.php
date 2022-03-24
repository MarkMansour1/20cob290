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
            FirstBranchSeeder::class,
            FirstPersonnelSeeder::class,
            FirstEquipmentSeeder::class,
            FirstSoftwareSeeder::class,
            FirstSuperProblemTypeSeeder::class,
            FirstSubProblemTypeSeeder::class,
            FirstSolutionSeeder::class,
            FirstSpecialistSeeder::class,
            FirstExpertiseSeeder::class,
            FirstProblemSeeder::class
        ]);
    }
}
