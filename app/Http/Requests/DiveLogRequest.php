<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiveLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'location' => 'string|required',
        ];
    }

    public function messages() {
        return [
            'location.required' => 'A  location is required',
            'location.text'     => 'Location must be a text entry.',
        ];
    }
}
