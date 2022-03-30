<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'street'   => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'city'     => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string'],
            'country'  => ['required', 'string', 'max:255'],
            'main'     => ['boolean'],
        ];

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'main' => $this->request->has('main'),
        ]);
    }
}
