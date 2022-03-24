<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSpecialistSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('specialist')->insert([
			[
				'id' => '1',
				'personnel_id' => '4',
				'no_of_jobs' => '1',
				'status' => '1'
			], [
				'id' => '2',
				'personnel_id' => '5',
				'no_of_jobs' => '1',
				'status' => '1'
			], [
				'id' => '3',
				'personnel_id' => '6',
				'no_of_jobs' => '1',
				'status' => '0'
			]
		]);
	}
}
