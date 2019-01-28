<?php

namespace App;

use Illuminate\Http\Request;

class BlogPage extends Page {
    public const PAGE_TYPE = 'blog';

    protected static function boot() {
        parent::boot();

        static::creating(function ($query) {
            $query->page_type = self::PAGE_TYPE;
        });
    }

    public function newQuery() {
        return parent::newQuery()->where('page_type', self::PAGE_TYPE);
    }

    public static function persist(BlogPage $post, Request $request, $href): BlogPage {
        $post->slug      = $href;
        $post->is_active = true;
        $post->data      = [
            'content'           => $request->input('content'),
            'images'            => $request->input('images'),
            'short_description' => $request->input('short_description'),
            'title'             => $request->input('title'),
        ];

        return $post;
    }
}
