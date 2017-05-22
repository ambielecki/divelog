<?php

namespace App;

use App\ImageFolder;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model
{
    public function image_placements() {
        return $this->hasMany('app\ImagePlacement');
    }

    public function image_folder() {
        return $this->belongsTo('app\ImageFolder');
    }

    public static function uploadImage(Request $request) {
        try {
            $image = InterventionImage::make($request->file('photo'))->encode('jpg');
            $width = $image->width();
            if ($width > 2000) {
                $image->resize(2000, null, function($constraint) {
                    $constraint->aspectRatio();
                });
            }

            // check if folder exists, if not create it
            $folder = ImageFolder::find($request->input('folder'));
            $fileName = uniqid($folder->name.'_', false);
            $path = $folder->name.'/'.$fileName.'jpg';

            if ($image->save(storage_path().'/app/images/'.$path.'.jpg')) {
                $dbImage = new Image();
                $dbImage->filename = $fileName;
                $dbImage->image_folder_id =  $request->input('folder');
                $dbImage->header = $request->input('header');
                $dbImage->subheader = $request->input('subheader');
                $dbImage->description = $request->input('description');
                if ($request->input('active')) {
                    $dbImage->active = 1;
                } else {
                    $dbImage->active = 0;
                }
                $dbImage->save();
            }
            return true;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }

    }
}
