<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branch')->insert([
			[
				'id' => '1',
				'name' => 'London Branch',
				'city' => 'London',
				'country' => 'UK',
				'telephone' => '55555666666'
			],[
				'id' => '2',
				'name' => 'Tokyo Branch',
				'city' => 'Tokyo',
				'country' => 'Japan',
				'telephone' => '33333666666'
			]
        ]);
    }
}
