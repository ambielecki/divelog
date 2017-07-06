<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogCalculatorRequest extends FormRequest
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
            'previous_pg'      => 'alpha|max:1|required_with:surface_interval|nullable',
            'surface_interval' => 'numeric|required_with:previous_pg|nullable',
            'max_depth'        => 'numeric||max:140',
            'bottom_time'      => 'numeric|required',
        ];
    }

    public function messages() {
        return [
            'previous_pg.alpha'              => 'Only a single letter is allowed for previous PG',
            'previous_pg.max'                => 'Only a single letter is allowed for previous PG',
            'previous_pg.required_with'      => 'Surface Interval is required with Previous PG',
            'surface_interval.numeric'       => 'Surface Interval Must Be a Number',
            'surface_interval.required_with' => 'Previous PG is required with Surface Interval',
            'max_depth.numeric'              => 'Max Depth Must Be a Number',
            'max_depth.required'             => 'Max Depth is Required',
            'max_depth.max'                  => 'Max Depth Cannot Exceed 140ft',
            'bottom_time.numeric'            => 'Bottom Time Must Be a Number',
            'bottom_time.required'           => 'Bottom Time is Required',
        ];
    }
}
