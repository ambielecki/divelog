<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class DiveLogPage extends Model
{
    protected $collection = 'dive_log';

    protected $connection = 'mongodb';

    protected $fillable = [
        'activities',
        'comments',
        'date',
        'dive_number',
        'dive_site',
        'location',
        'time_in',
        'time_out',
        'in_am_pm',
        'out_am_pm',
        'previous_pg',
        'tank',
        'surface_interval',
        'bottom_time',
        'max_depth',
        'pressure_group',
        'user_id',
        'environment',
        'type',
        'conditions',
        'weather',
        'temperature',
        'visibility',
        'weight',
        'wetsuit',
        'tide',
    ];
}
