<?php

use App\ImagePlacement;
use Illuminate\Database\Seeder;

class ImagePlacementSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $placements = [
            ['carousel1', 'carousel'],
            ['carousel2', 'carousel'],
            ['image1', 'single'],
            ['image2', 'single'],
            ['image3', 'single'],
            ['image4', 'single'],
            ['image5', 'single'],
            ['hero', 'hero']
        ];
        foreach ($placements as $placement) {
            $dbPlacement       = new ImagePlacement();
            $dbPlacement->name = $placement[0];
            $dbPlacement->type = $placement[1];
            $dbPlacement->save();
        }
    }
}
