<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Image;
use App\ImageFolder;
use App\ImagePlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

/**
 * Class ImageController functions for returning images
 * @package App\Http\Controllers
 */
class ImageController extends Controller
{
    /**
     * return images from app storage, request param size will resize image
     *
     * @param $request Request
     * @param $folder string the folder where the image live
     * @param $fileName string the image name
     * @return mixed the image response
     */
    public function getImage(Request $request, $folder, $fileName) {
        $image = InterventionImage::make(Storage::get('images/'.$folder.'/'.$fileName));
        if ($request->input('size')) {
            $image->resize($request->input('size'), null, function($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $image->response();
    }


    /**
     * return a view with a full size image
     *
     * @param $folder string the folder where the image live
     * @param $fileName string the image name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFullImage($folder, $fileName) {
        return view('pages.image', [
            'folder'    => $folder,
            'fileName'  => $fileName
        ]);
    }

    public function getImageList() {
        $folders = ImageFolder::get();
        return view('admin.image.image_list', [
            'folders'   => $folders
        ]);
    }

    public function postImageList(Request $request) {
        $folder = ImageFolder::with('images')->find($request->input('folder'));
        $response_images = [];
        foreach ($folder->images as $image) {
            $this_image = [
                'folder'    => $folder->name,
                'id'        => $image->id,
                'name'      => $image->filename,
                'path'      => '/images/' . $folder->name . '/' . $image->filename . '.jpg?size=150'
            ];
            array_push($response_images, $this_image);
        }
        return response()->json([
            'images'   => $response_images
        ]);
    }

    public function postImageDetail(Request $request) {
        $image = Image::with('image_folder')->find($request->input('image'));
        $image_response = [
            'id'            => $image->id,
            'name'          => $image->filename,
            'header'        => $image->header,
            'subheader'     => $image->subheader,
            'description'   => $image->description,
            'folder'        => $image->image_folder->name,
            'path'          => '/images/' . $image->image_folder->name . '/' . $image->filename . '.jpg'
        ];
        return response()->json([
            'image' => $image_response
        ]);
    }

    /**
     * return a view to upload images
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUploadImage() {
        $folders = ImageFolder::orderBy('name', 'asc')->get();
        return view('admin.image.image_upload', [
            'folders' => $folders
        ]);
    }

    public function postUploadImage(ImageUploadRequest $request) {
        $status = Image::uploadImage($request);
        if ($status) {
            Session::flash('flash_success', 'Image Uploaded Successfully');
            return redirect()->route('image_list');
        } else {
            Session::flash('flash_warning', 'There was a problem saving your image, please try again');
            return redirect()->route('image_upload')->withInput();
        }
    }

    public function getFolderList() {
        $folders = ImageFolder::get();
        dump($folders->toArray());
    }

    public function getFolderCreate() {
        return view('admin.image.image_folder_create');
    }

    public function postFolderCreate(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $name = strtolower($request->input('name'));
        $count = ImageFolder::where('name', '=', $name)->count();
        if ($count) {
            Session::flash('flash_warning', 'There was a problem saving your folder, the name already exists, please try again.');
            return redirect()->route('image_folder_create')->withInput();
        } else {
            $result = ImageFolder::createFolder($name);
        }
        if ($result) {
            Session::flash('flash_success', 'Image Uploaded Successfully');
            return redirect()->route('image_folder_list');
        } else {
            Session::flash('flash_warning', 'There was a problem saving your folder, please try again');
            return redirect()->route('image_folder_create')->withInput();
        }
    }
}
