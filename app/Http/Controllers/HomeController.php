<?php

namespace App\Http\Controllers;

use App\Image;
use App\ImageFolder;
use App\MongoPage;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function getHome() {
        $page = MongoPage::where('name', '=', 'home')->where('active', '=', true)->orderBy('created_at', 'DESC')->first();
        $heroImage = $page->image_hero ? Image::with('image_folder') ->find($page->image_hero) : '';
        $carouselImages = $page->images_carousel ? Image::with('image_folder')->findMany($page->images_carousel) : [];
        $singleImages = $page->images_single ? Image::with('image_folder')->findMany($page->images_single) : [];
        return view('home', [
            'title'             => $page->title,
            'content'           => $page->content,
            'heroTitle'         => $page->hero_title ? $page->hero_title : "",
            'heroImage'         => $heroImage,
            'carouselTitle'     => $page->carousel_title ? $page->carousel_title : "",
            'carouselImages'    => $carouselImages,
            'singleImages'      => $singleImages
        ]);
    }

    public function getEditHome() {
        $page = MongoPage::where('name', '=', 'home')->where('active', '=', true)->orderBy('created_at', 'DESC')->first();
        $images = ImageFolder::where('name', '=', 'home')->with('images')->first();
        $heroImages = ImageFolder::where('name', '=', 'hero')->with('images')->first();
        return view('admin.home_edit', [
            'heroImages'        => $heroImages,
            'selectedHero'      => $page->hero_image ? $page->hero_image : "",
            'heroTitle'         => $page->hero_title ? $page->hero_title : "",
            'images'            => $images,
            'selectedCarousel'  => $page->images_carousel ? $page->images_carousel : [],
            'selectedSingle'    => $page->images_single ? $page->images_single : [],
            'page'              => $page
        ]);
    }

    public function postEditHome(Request $request) {
        $previousPages = MongoPage::where('name', '=', 'home')->where('active', '=', true)->get();
        foreach ($previousPages as $previousPage) {
            $previousPage->active = false;
            $previousPage->save();
        }
        $page = new MongoPage();
        $page->name = 'home';
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        if ( $request->input('hero_title') != "") {
            $page->hero_title = $request->input('hero_title');
        }
        $page->image_hero = $request->input('image_hero');
        $page->images_single = $request->input('image_single');
        if ( $request->input('carousel_title') != "") {
            $page->carousel_title = $request->input('carousel_title');
        }
        $page->images_carousel = $request->input('image_carousel');
        $page->active = $request->input('active') ? true : false;
        $page->save();
        Session::flash('flash_success', 'Home Page Edit Successfull');
        return redirect()->route('home_edit');
    }
}
