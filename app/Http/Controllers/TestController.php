<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\ImageFolder;
use Storage;
use App\MongoPage;
use App\Libraries\DiveCalculator;

class TestController extends Controller
{
    public function getTest2() {
       $page = new MongoPage();
       $page->title = "Here's the title again";
       $page->content = "More, content, content.";
       if ($page->save()) {
           return "Success";
       } else {
           return "Failure";
       }
    }
}
