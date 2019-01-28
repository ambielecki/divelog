<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model {
    public function image_placements() {
        return $this->hasMany('App\ImagePlacement');
    }

    public function image_folder() {
        return $this->belongsTo('App\ImageFolder');
    }

    public static function uploadImage(Request $request) {
        try {
            $image = InterventionImage::make($request->file('photo'))->encode('jpg');
            $width = $image->width();
            if ($width > 2000) {
                $image->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            // check if folder exists, if not create it
            $folder   = ImageFolder::find($request->input('folder'));
            $fileName = uniqid($folder->name . '_', false);
            $path     = $folder->name . '/' . $fileName;

            if ($image->save(storage_path() . '/app/images/' . $path . '.jpg')) {
                $dbImage                  = new Image();
                $dbImage->filename        = $fileName;
                $dbImage->image_folder_id = $request->input('folder');
                $dbImage->header          = $request->input('header');
                $dbImage->subheader       = $request->input('subheader');
                $dbImage->description     = $request->input('description');
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

    public static function editImage(Request $request) {
        try {
            $image                  = Image::find($request->input('id'));
            $image->image_folder_id = $request->input('folder');
            $image->header          = $request->input('header');
            $image->subheader       = $request->input('subheader');
            $image->description     = $request->input('description');
            $image->save();

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
