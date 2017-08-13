<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $shirt = new Product();
        $shirt->name = 'Test shirt 1';
        $shirt->description = "It's a shirt.";
        $shirt->price = 9.99;
        $shirt->stock = 25;
        $shirt->save();

        $pants = new Product();
        $pants->name = 'Test pants 1';
        $pants->description = "They're pants.";
        $pants->price = 14.99;
        $pants->stock = 20;
        $pants->save();

        $hat = new Product();
        $hat->name = 'Test hat 1';
        $hat->description = "It's a hat.";
        $hat->price = 19.99;
        $hat->stock = 15;
        $hat->save();

        $jacket = new Product();
        $jacket->name = 'Test jacket 1';
        $jacket->description = "It's a jacket.";
        $jacket->price = 99.99;
        $jacket->stock = 0;
        $jacket->save();
    }
}
