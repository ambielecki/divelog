<?php

use App\ImageFolder;
use Illuminate\Database\Seeder;

class ImageFoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folders = ['mexico', 'jamaica', 'bahamas', 'bermuda', 'bonaire', 'aruba', 'general'];
        foreach ($folders as $folder) {
            ImageFolder::createFolder($folder);
        }
    }
}
