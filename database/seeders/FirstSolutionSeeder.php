<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('solution')->insert([
			[
				'id' => '1',
				'solution' => 'Turn off and on',
				'solution_description' => 'Turn the device off safely for 1 minute and then turn it back on',
				'times_used' => '5',
				'sub_problem_type_id' => '5',
				'super_problem_type_id' => '3'
			],[
				'id' => '2',
				'solution' => 'Check power',
				'solution_description' => 'See if the device is pluged in properly',
				'times_used' => '5',
				'sub_problem_type_id' => '3',
				'super_problem_type_id' => '2'
			],[
				'id' => '3',
				'solution' => 'Run as administrator',
				'solution_description' => 'Right click on program and select run as administrator',
				'times_used' => '10',
				'sub_problem_type_id' => '5',
				'super_problem_type_id' => '3'
			]
        ]);
    }
}
