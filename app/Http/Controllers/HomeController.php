<?php

namespace App\Http\Controllers;

use App\BlogPage;
use App\Image;
use App\ImageFolder;
use App\HomePage;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller {
    public function getHome() {
        $page = HomePage::where('slug', '=', 'home')
            ->where('is_active', '=', true)
            ->orderBy('created_at', 'DESC')
            ->first();

        $page = $page ?: new HomePage();

        $image_hero = $page->image_hero ? Image::with('image_folder')->find($page->image_hero) : '';
        $images_carousel = $page->images_carousel ? Image::with('image_folder')->findMany($page->images_carousel) : [];
        $images_single = $page->images_single ? Image::with('image_folder')->findMany($page->images_single) : [];
        $posts = BlogPage::where('is_active', '=', true)->orderBy('created_at', 'DESC')->limit(5)->get();
        $posts_images = [];

        foreach ($posts as $post) {
            $posts_images[] = Image::with('image_folder')->findMany($post->images);
        }

        return view(
            'home', [
                'page'            => $page,
                'data'            => $page->data ?: [],
                'image_hero'      => $image_hero,
                'images_carousel' => $images_carousel,
                'images_single'   => $images_single,
                'posts'           => [],
                'posts_images'    => $posts_images,
            ]
        );
    }

    public function getEditHome() {
        $page = HomePage::where('slug', '=', 'home')
            ->where('is_active', '=', true)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$page) {
            $page = new HomePage();
        }

        $images = ImageFolder::where('name', '=', 'home')->with('images')->first();
        $hero_images = ImageFolder::where('name', '=', 'hero')->with('images')->first();

        return view(
            'admin.home_edit', [
            'page'        => $page,
            'hero_images' => $hero_images,
            'images'      => $images,
        ]);
    }

    public function postEditHome(Request $request) {
        HomePage::where('slug', '=', 'home')
            ->where('is_active', '=', true)
            ->update(['is_active' => false]);

        $page = new HomePage();
        $page->slug = 'home';
        $page->is_active = true;
        $page->data = [
            'name'            => 'home',
            'title'           => $request->input('title'),
            'content'         => $request->input('content'),
            'hero_title'      => $request->input('hero_title') ?: null,
            'image_hero'      => $request->input('image_hero'),
            'images_single'   => $request->input('image_single'),
            'carousel_title'  => $request->input('carousel_title') ?: null,
            'images_carousel' => $request->input('image_carousel'),
        ];

        $page->save();
        Session::flash('flash_success', 'Home Page Edit Successful');

        return redirect()->route('home_edit');
    }
}
