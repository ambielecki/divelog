<?php

namespace App\Http\Controllers;

use App\Image;
use App\ImageFolder;
use App\ImagePlacement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome() {
        return view('home');
    }

    public function getEditHome() {
        $images = ImageFolder::where('name', '=', 'home')->with('images')->first();
        $heroImages = ImageFolder::where('name', '=', 'hero')->with('images')->first();
        dump($images->toArray());
        return view('admin.home_edit', [
            'images'        => $images,
            'heroImages'    => $heroImages
        ]);
    }

    public function postEditHome(Request $request) {
        dump($request);
    }
}
