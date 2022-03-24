<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstProblemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('problem')->insert([
			[
				'id' => '1',
				'personnel_id' => '1',
				'specialist_id' => '1',
				'branch' => '1',
				'status' => '0',
				'in_person' => '0',
				'super_problem_type_id' => '3',
				'sub_problem_type_id' => '5',
				'os' => 'Sales',
				'software' => 'Windows',
				'serial_no' => '055'
			], [
				'id' => '2',
				'personnel_id' => '2',
				'specialist_id' => '2',
				'branch' => '1',
				'status' => '0',
				'in_person' => '0',
				'super_problem_type_id' => '3',
				'sub_problem_type_id' => '5',
				'os' => 'Sales',
				'software' => 'Windows',
				'serial_no' => '055'
			], [
				'id' => '3',
				'personnel_id' => '3',
				'specialist_id' => '3',
				'branch' => '2',
				'status' => '0',
				'in_person' => '0',
				'super_problem_type_id' => '2',
				'sub_problem_type_id' => '3',
				'os' => 'Sales',
				'software' => 'Windows',
				'serial_no' => '055'
			]
		]);
	}
}
