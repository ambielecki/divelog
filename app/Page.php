<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Page extends Model {
    protected $table = 'pages';

    protected $casts = [
        'active' => 'boolean',
        'data'   => 'array',
    ];

    public const PAGE_TYPE = 'default';

    public static function createSlug(string $title): string {
        $href = preg_replace('/\s+|\:+|\_+|\/+/', '-', $title);
        $href = str_replace('.', '', $href);
        $href = strtolower(trim(preg_replace('/\-+/', '-', $href)));

        return $href;
    }

    public static function slugCheck(Page $model, string $slug): bool {
        $pages = $model->where('slug', $slug)->get();

        return $pages->count() > 0;
    }
}
