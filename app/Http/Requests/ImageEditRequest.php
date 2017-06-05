<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageEditRequest extends FormRequest
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
            'folder'        => 'required',
            'heading'       => 'string|nullable',
            'subheading'    => 'string|nullable',
            'description'   => 'string|required|max:140'
        ];
    }

    public function messages()
    {
        return [
            'folder.required'       => 'Please Select a Folder',
            'description.required'  => 'Please provide a short description',
            'description.max'       => 'Maximum Length is 140 characters'
        ];
    }
}
