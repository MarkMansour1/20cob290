<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirstSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('software')->insert([
			[
				'software' => 'Apple'
			],[
				'software' => 'Windows'
			],[
				'software' => 'Linux'
			]
        ]);
    }
}