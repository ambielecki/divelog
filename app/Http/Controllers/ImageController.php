<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageEditRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Image;
use App\ImageFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

/**
 * Class ImageController functions for returning images
 * @package App\Http\Controllers
 */
class ImageController extends Controller {
    public function getImage(Request $request, string $folder, string $fileName) {
        $image = InterventionImage::make(Storage::get('images/'.$folder.'/'.$fileName));
        if ($request->input('size')) {
            $image->resize($request->input('size'), null, function ($constraint) {
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

    /**
     * get the lists of images
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getImageList() {
        $folders = ImageFolder::get();

        return view('admin.image.image_list', [
            'folders'   => $folders
        ]);
    }


    /**
     * ajax method to return a list of images in a folder
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postImageList(Request $request) {
        $folder          = ImageFolder::with('images')->find($request->input('folder'));
        $response_images = [];
        foreach ($folder->images as $image) {
            $this_image = [
                'folder'    => $folder->name,
                'id'        => $image->id,
                'name'      => $image->filename,
                'path'      => '/images/' . $folder->name . '/' . $image->filename . '.jpg?size=150'
            ];

            $response_images[] = $this_image;
        }

        return response()->json([
            'images'   => $response_images
        ]);
    }

    /**
     * ajax method to get the details of an image
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postImageDetail(Request $request) {
        $image          = Image::with('image_folder')->find($request->input('image'));
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
     * edit an image
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id) {
        $image = Image::with('image_folder')->find($id);
        if (!$image) {
            Session::flash('flash_warning', 'Image does not exist, please try again');

            return redirect()->route('image_list');
        }
        $folders = ImageFolder::get();

        return view('admin.image.image_edit', [
            'image'     => $image,
            'folders'   => $folders,
            'id'        => $id
        ]);
    }

    /**
     * process image edit
     *
     * @param ImageEditRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postEdit(ImageEditRequest $request) {
        $status = Image::editImage($request);
        if ($status) {
            Session::flash('flash_success', 'Image Updated Successfully');

            return redirect()->route('image_list');
        }

        Session::flash('flash_warning', 'There was a problem saving your data, please try again');

        return redirect('/admin/image_edit/' . $request->input('id'))->withInput();
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
        $route = 'image_list';
        if ('add' === $request->input('submit_action')) {
            $route = 'image_upload';
        }
        $status = Image::uploadImage($request);
        if ($status) {
            Session::flash('flash_success', 'Image Uploaded Successfully');

            return redirect()->route($route);
        }

        Session::flash('flash_warning', 'There was a problem saving your image, please try again');

        return redirect()->route('image_upload')->withInput();
    }

    public function getFolderList() {
        $folders = ImageFolder::get();
        // TODO
        dump($folders->toArray());
    }

    public function getFolderCreate() {
        return view('admin.image.image_folder_create');
    }

    public function postFolderCreate(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $name  = strtolower($request->input('name'));
        $count = ImageFolder::where('name', '=', $name)->count();

        if ($count) {
            Session::flash('flash_warning', 'There was a problem saving your folder, the name already exists, please try again.');

            return redirect()->route('image_folder_create')->withInput();
        }

        $result = ImageFolder::createFolder($name);
        if ($result) {
            Session::flash('flash_success', 'Image Uploaded Successfully');

            return redirect()->route('image_folder_list');
        }

        Session::flash('flash_warning', 'There was a problem saving your folder, please try again');

        return redirect()->route('image_folder_create')->withInput();
    }
}
