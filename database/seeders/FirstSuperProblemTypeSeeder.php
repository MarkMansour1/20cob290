<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSuperProblemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('super_problem_type')->insert([
			[
				'id' => '1',
				'name' => 'Screen'
			],[
				'id' => '2',
				'name' => 'Power'
			],[
				'id' => '3',
				'name' => 'Software'
			]
        ]);
    }
}
