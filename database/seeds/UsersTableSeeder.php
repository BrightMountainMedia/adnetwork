<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     ['id' => 1, 'first_name' => 'Michael', 'last_name' => 'Stoffer', 'email' => 'mstoffer@brightmountainmedia.com', 'password' => bcrypt('password'), 'role' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        factory(User::class, 50)->create();
    }
}
