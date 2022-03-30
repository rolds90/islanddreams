<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CruiseRequest extends FormRequest
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
            'origin'    => ['required', 'string', 'max:255'],
            'vessel'    => ['required', 'string', 'max:255'],
            'trip_type' => ['required', Rule::in(['Round Trip', 'One-way'])],
            'depart_at' => ['required', 'date'],
            'days'      => ['required', 'numeric'],
            'nights'    => ['required', 'numeric'],
            'image'     => ['image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'ItineraryFields.*.image'          => ['sometimes', 'required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'ItineraryFields.*.day'            => ['sometimes', 'required', 'numeric'],
            'ItineraryFields.*.location'       => ['sometimes', 'required', 'string', 'max:255'],
            'ItineraryFields.*.itinerary_date' => ['sometimes', 'required', 'date'],
        ];

        return $rules;
    }
}
