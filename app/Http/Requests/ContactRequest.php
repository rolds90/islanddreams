<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:255'],
            'contact_no'   => ['required_without:email', 'nullable', 'string', 'max:255'],
            'email'        => ['required_without:contact_no', 'nullable','email'],
            'main_contact' => ['boolean'],
            'main_email'   => ['boolean'],
        ];

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'main_contact'    => $this->request->has('main_contact'),
            'main_email' => $this->request->has('main_email'),
        ]);
    }
}
