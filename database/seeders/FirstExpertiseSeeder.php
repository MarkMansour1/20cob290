<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expertise')->insert([
			[
				'specialist_id' => '3',
				'super_problem_type_id' => '2'
			],[
				'specialist_id' => '2',
				'super_problem_type_id' => '3'
			],[
				'specialist_id' => '1',
				'super_problem_type_id' => '3'
			]
        ]);
    }
}
