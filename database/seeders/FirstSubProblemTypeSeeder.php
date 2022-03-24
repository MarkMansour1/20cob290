<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSubProblemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_problem_type')->insert([
			[
				'id' => '1',
				'super_type_id' => '1',
				'name' => 'Frozen'
			],[
				'id' => '2',
				'super_type_id' => '1',
				'name' => 'Blue'
			],[
				'id' => '3',
				'super_type_id' => '2',
				'name' => 'Does not turn on'
			],[
				'id' => '4',
				'super_type_id' => '2',
				'name' => 'Turns off'
			],[
				'id' => '5',
				'super_type_id' => '3',
				'name' => 'Does not turn on'
			],[
				'id' => '6',
				'super_type_id' => '3',
				'name' => 'Crashes'
			]
        ]);
    }
}
