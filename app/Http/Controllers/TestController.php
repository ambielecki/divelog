<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\ImageFolder;
use Storage;
use App\MongoPage;
use App\Libraries\DiveCalculator;
use App\BlogPage;

class TestController extends Controller
{
    public function getTest2() {
        $test_string = "Here is_ :a test:Title 6/7/10";
        return BlogPage::createHref($test_string);
    }
}
