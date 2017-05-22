<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Storage;

class ImageFolder extends Model
{
    public function images() {
        return $this->hasMany('app\Images');
    }

    public static function createFolder($name) {
        try {
            Storage::makeDirectory("images/$name");
            $folder = new ImageFolder();
            $folder->name = $name;
            $folder->save();
            return true;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
