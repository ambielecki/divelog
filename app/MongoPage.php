<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class MongoPage extends Model {
    protected $collection = 'mongo_page';

    protected $connection = 'mongodb';
}
