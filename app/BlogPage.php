<?php

namespace App;

use Illuminate\Http\Request;

class BlogPage extends Page {
    protected static function boot() {
        parent::boot();

        static::creating(function ($query) {
            $query->page_type = 'blog';
        });
    }

    public static function createHref(string $title): string {
        $href = preg_replace('/\s+|\:+|\_+|\/+/', '-', $title);
        $href = str_replace('.', '', $href);
        $href = strtolower(trim(preg_replace('/\-+/', '-', $href)));

        return $href;
    }

    public static function persist(BlogPage $post, Request $request, $href): BlogPage {
        $post->slug = $href;
        $post->active = true;
        $post->data = [
            'content'           => $request->input('content'),
            'images'            => $request->input('images'),
            'short_description' => $request->input('short_description'),
            'title'             => $request->input('title'),
        ];

        return $post;
    }
}
