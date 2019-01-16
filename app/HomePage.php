<?php

namespace App;

class HomePage extends Page {
    protected static function boot() {
        parent::boot();

        static::creating(function ($query) {
            $query->page_type = 'home';
        });
    }
}
