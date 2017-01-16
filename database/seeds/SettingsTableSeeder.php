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
        App\Settings::create(['name' => 'widget_title', 'value' => 'Popular Articles']);
        App\Settings::create(['name' => 'widget_count', 'value' => 3]);
    }
}
