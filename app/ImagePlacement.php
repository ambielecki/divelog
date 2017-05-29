<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagePlacement extends Model
{
    const PLACEMENT_TYPES = [
        'carousel',
        'left',
        'right',
        'banner',
        'hero'
    ];

    public function images() {
        return $this->hasMany('App\Image');
    }
}
