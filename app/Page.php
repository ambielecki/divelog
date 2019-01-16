<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Page extends Model {
    protected $table = 'pages';

    protected $casts = [
        'active' => 'boolean',
        'data'   => 'array',
    ];
}
