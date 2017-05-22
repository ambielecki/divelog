<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'         => 'required|image|max:10000',
            'folder'        => 'required',
            'heading'       => 'string|nullable',
            'subheading'    => 'string|nullable',
            'description'   => 'string|required|max:140'
        ];
    }

    public function messages()
    {
        return [
            'photo.required'        => 'Please select a file',
            'photo.image'           => 'File type not recognized, please select a valid image',
            'photo.max'             => 'Upload max 10M',
            'folder.required'       => 'Please Select a Folder',
            'description.required'  => 'Please provide a short description',
            'description.max'       => 'Maximum Length is 140 characters'
        ];
    }
}
