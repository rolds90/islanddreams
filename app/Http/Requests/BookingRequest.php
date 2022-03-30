<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'type'         => ['required'],
            'origin'       => ['required', 'string', 'max:255'],
            'destination'  => ['required', 'string', 'max:255'],
            'travel_date'  => ['required', 'date'],
            'arrival_date' => ['required', 'date'],
            'courier_id'   => ['required'],
        ];

        return $rules;
    }
}
