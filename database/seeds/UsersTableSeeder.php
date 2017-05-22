<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Andrew Bielecki";
        $user->email = "ambielecki@gmail.com";
        $user->password = Hash::make('testing');
        $user->level = 1;
        $user->save();

        $user = new User();
        $user->name = "Andrew Bielecki";
        $user->email = "ambielecki@yahoo.com";
        $user->password = Hash::make('testing');
        $user->level = 2;
        $user->save();
    }
}
