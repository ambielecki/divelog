<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ImageFoldersTableSeeder::class);
        $this->call(ImagePlacementSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
