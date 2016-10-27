<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	['id' => 1, 'role' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        	['id' => 2, 'role' => 'publisher', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
