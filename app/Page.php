<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    protected $casts = [
        'active' => 'boolean',
        'data'   => 'array',
    ];
}
