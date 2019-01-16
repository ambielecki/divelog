<?php

namespace App;

class HomePage extends Page {
    public const PAGE_TYPE = 'home';

    protected static function boot() {
        parent::boot();

        static::creating(function ($query) {
            $query->page_type = self::PAGE_TYPE;
        });
    }

    public function newQuery() {
        return parent::newQuery()->where('page_type', self::PAGE_TYPE);
    }
}
