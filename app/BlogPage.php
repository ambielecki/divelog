<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Http\Request;

class BlogPage extends Model
{
    protected $collection = 'blog_page';

    protected $connection = 'mongodb';

    /**
     * @param $title
     * @return mixed|string
     */
    public static function createHref($title) {
        $href = preg_replace('/\s+|\:+|\_+|\/+/', '-', $title);
        $href = preg_replace('/\./', '', $href);
        $href = strtolower(trim(preg_replace('/\-+/', '-', $href)));
        return $href;
    }

    public static function persist(BlogPage $post, Request $request, $href) {
        $post->title = $request->input('title');
        $post->href = $href;
        $post->short_description = $request->input('short_description');
        $post->content = $request->input('content');
        $post->images = $request->input('images');
        $post->is_active = true;
        return $post;
    }
}
