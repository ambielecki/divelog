<?php

namespace App\Http\Controllers;

use App\BlogPage;
use App\Image;
use App\ImageFolder;
use App\MongoPage;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function getHome() {
        $page = MongoPage::where('name', '=', 'home')->where('active', '=', true)->orderBy('created_at', 'DESC')->first();
        $image_hero = $page->image_hero ? Image::with('image_folder') ->find($page->image_hero) : '';
        $images_carousel = $page->images_carousel ? Image::with('image_folder')->findMany($page->images_carousel) : [];
        $images_single = $page->images_single ? Image::with('image_folder')->findMany($page->images_single) : [];
        $posts = BlogPage::where('is_active', '=', true)->orderBy('created_at', 'DESC')->limit(5)->get();
        $posts_images = [];
        foreach ($posts as $post) {
            $posts_images[] = Image::with('image_folder')->findMany($post->images);
        }

        return view('home', [
            'page'              => $page,
            'image_hero'        => $image_hero,
            'images_carousel'   => $images_carousel,
            'images_single'     => $images_single,
            'posts'             => $posts,
            'posts_images'      => $posts_images
        ]);
    }

    public function getEditHome() {
        $page = MongoPage::where('name', '=', 'home')->where('active', '=', true)->orderBy('created_at', 'DESC')->first();
        if (!$page) {
            $page = new MongoPage();
        }
        $images = ImageFolder::where('name', '=', 'home')->with('images')->first();
        $hero_images = ImageFolder::where('name', '=', 'hero')->with('images')->first();

        return view('admin.home_edit', [
            'page'              => $page,
            'hero_images'       => $hero_images,
            'images'            => $images,
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
        if ($request->input('hero_title') != "") {
            $page->hero_title = $request->input('hero_title');
        }
        $page->image_hero = $request->input('image_hero');
        $page->images_single = $request->input('image_single');
        if ($request->input('carousel_title') != "") {
            $page->carousel_title = $request->input('carousel_title');
        }
        $page->images_carousel = $request->input('image_carousel');
        $page->active = $request->input('active') ? true : false;
        $page->save();
        Session::flash('flash_success', 'Home Page Edit Successful');
        return redirect()->route('home_edit');
    }
}
