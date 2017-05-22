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

    public function page_placements() {
        return $this->hasMany('app\PagePlacement');
    }
}
