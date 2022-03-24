<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
			[
				'serial_no' => '055',
				'type' => 'MX2000',
				'make' => 'HP',
				'branch_id' => 1
			],[
				'serial_no' => '666',
				'type' => 'Lotus',
				'make' => 'Umbrella',
				'branch_id' => 2
			],[
				'serial_no' => '777',
				'type' => 'Scanner',
				'make' => 'Dell',
				'branch_id' => 1
			]
        ]);
    }
}
