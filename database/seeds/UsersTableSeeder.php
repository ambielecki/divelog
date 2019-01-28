<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user           = new \App\User();
        $user->name     = 'Andrew Bielecki';
        $user->email    = 'ambielecki@gmail.com';
        $user->password = Hash::make('Ch@ng3m3');
        $user->level    = 1;
        $user->save();
    }
}
