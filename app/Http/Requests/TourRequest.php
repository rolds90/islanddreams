<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
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
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'unique:tours'],
            'location'  => ['required', 'string', 'max:255'],
            'days'      => ['required', 'numeric'],
            'nights'    => ['required', 'numeric'],
            'expire_at' => ['required', 'date'],
            'image'     => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'ItineraryFields.*.day' => ['sometimes', 'required', 'numeric'],
            'ItineraryFields.*.title' => ['sometimes', 'required'],
            'ItineraryFields.*.description' => ['sometimes', 'required'],
            'InclusionFields.*.description' => ['sometimes', 'required'],
        ];

        return $rules;
    }
}
