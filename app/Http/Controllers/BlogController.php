<?php

namespace App\Http\Controllers;

use App\BlogPage;
use App\Image;
use App\ImageFolder;
use Illuminate\Http\Request;
use Session;

class BlogController extends Controller {
    public function getList($page = 1) {
        $limit = 10;
        $skip  = 0;

        if ($page) {
            $skip = ($page - 1) * $limit;
        }

        $pages = ceil(BlogPage::where('is_active', '=', true)->count() / $limit);
        $posts = BlogPage::where('is_active', true)
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->limit($limit)
            ->get();

        return view('blog.blog_list', [
            'posts'        => $posts,
            'pages'        => $pages,
            'current_page' => $page,
            'limit'        => $limit,
            'skip'         => $skip,
        ]);
    }

    public function getView($slug) {
        $page   = BlogPage::where('href', '=', $slug)->where('is_active', '=', true)->first();
        $images = Image::whereIn('id', $page->images)->with('image_folder')->get();

        return view('blog.blog_view', [
            'page'   => $page,
            'images' => $images,
        ]);
    }

    public function getAdminList($page = 1) {
        $limit = 10;
        $skip  = 0;

        if ($page) {
            $skip = ($page - 1) * $limit;
        }

        $pages = ceil(BlogPage::where('is_active', '=', true)->count() / $limit);
        $posts = BlogPage::where('is_active', '=', true)
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->limit($limit)
            ->get();

        return view('admin.blog.blog_list', [
            'posts'        => $posts,
            'pages'        => $pages,
            'current_page' => $page,
            'limit'        => $limit,
            'skip'         => $skip,
        ]);
    }

    public function getCreate() {
        $folders = ImageFolder::get();

        return view('admin.blog.blog_create', [
            'folders' => $folders,
        ]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'title'             => 'string|max:120|required',
            'short_description' => 'string|max:1000|required',
            'content'           => 'required',
        ]);

        $slug = BlogPage::createSlug($request->input('title'));

        $post       = new BlogPage();
        $slug_check = BlogPage::slugCheck($post, $slug);

        if ($slug_check) {
            return redirect()
                ->route('blog_create')
                ->withInput()
                ->with('href_error', 'A similar title already exists, please try again');
        }

        $post = BlogPage::persist($post, $request, $slug);

        if ($post->save()) {
            Session::flash('flash_success', 'Post Created Successfully');

            return redirect()->route('blog_admin_list');
        }

        Session::flash('flash_warning', 'There was a problem with saving your post, please try again');

        return redirect()->route('blog_create')->withInput();
    }

    public function getEdit($slug) {
        $post          = BlogPage::where('is_active', '=', true)->where('href', '=', $slug)->first();
        $images        = Image::with('image_folder')->findMany($post->images);
        $image_folders = ImageFolder::with('images')->get();

        return view('admin.blog.blog_edit', [
            'post'          => $post,
            'images'        => $images,
            'image_folders' => $image_folders,
            'href'          => $slug,
        ]);
    }

    public function postEdit(Request $request, $slug) {
        $this->validate($request, [
            'title'             => 'string|max:120|required',
            'short_description' => 'string|max:1000|required',
            'content'           => 'required',
        ]);

        $previous_versions = BlogPage::where('is_active', '=', true)->where('href', '=', $slug)->get();

        foreach ($previous_versions as $version) {
            $version->is_active = false;
            $version->save();
        }

        $post = new BlogPage();
        $post = BlogPage::persist($post, $request, $slug);

        if ($post->save()) {
            Session::flash('flash_success', 'Post Edited Successfully');

            return redirect()->route('blog_admin_list');
        }

        Session::flash('flash_warning', 'There was a problem with saving your post, please try again');

        return redirect()->route('blog_edit', ['href' => $request->input('href')])->withInput();
    }

    public function postDisable($slug) {
        $posts = BlogPage::where('is_active', '=', true)->where('href', '=', $slug)->get();

        foreach ($posts as $post) {
            $post->is_active = false;
            if (!$post->save()) {
                Session::flash('flash_warning', 'There was a problem disabling this post, post try again');
            }
        }

        Session::flash('flash_success', 'Post Disabled');

        return redirect()->route('blog_admin_list');
    }

    public function postCheckHref(Request $request) {
        $this->validate($request, [
            'title' => 'string',
        ]);

        $title      = $request->input('title');
        $slug       = BlogPage::createSlug($title);
        $slug_check = BlogPage::where('href', '=', $slug)->get();
        $check      = true;

        if (count($slug_check)) {
            $check = false;
        }

        return response()->json([
            'href'  => $slug,
            'check' => $check,
        ]);
    }
}
