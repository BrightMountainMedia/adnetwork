<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['id' => 1, 'name' => 'widget_title', 'value' => 'Popular Articles', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'widget_count', 'value' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
