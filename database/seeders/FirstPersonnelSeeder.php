<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FirstPersonnelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'email' => 'alexjones@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Alex Jones',
				'job_title' => 'Office worker',
				'telephone' => '05555666666',
				'branch_id' => '1',
				'department' => 'Sales',
				'remember_token' => Str::random(10),
			], [
				'email' => 'timjones@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Tim Jones',
				'job_title' => 'analyst',
				'telephone' => '03333444444',
				'branch_id' => '1',
				'department' => 'Company Analysis',
				'remember_token' => Str::random(10),
			], [
				'email' => 'kentaromiura@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Kentaro Miura',
				'job_title' => 'Operations Manager',
				'telephone' => '02222111111',
				'branch_id' => '2',
				'department' => 'Operations',
				'remember_token' => Str::random(10),
			],
			[
				'email' => 'seth@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Seth',
				'job_title' => 'specialist',
				'telephone' => '05555666666',
				'branch_id' => '1',
				'department' => 'Technical',
				'remember_token' => Str::random(10),
			], [
				'email' => 'sam@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Sam',
				'job_title' => 'specialist',
				'telephone' => '03333444444',
				'branch_id' => '1',
				'department' => 'Technical',
				'remember_token' => Str::random(10),
			], [
				'email' => 'emb@hotmail.com',
				'email_verified_at' => now(),
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'name' => 'Ethan',
				'job_title' => 'specialist',
				'telephone' => '02222111111',
				'branch_id' => '2',
				'department' => 'Technical',
				'remember_token' => Str::random(10),
			],
		]);
	}
}
