<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
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
            'title'      => ['required', 'string', 'max:255', 'unique:promos'],
            'date_start' => ['required', 'date'],
            'date_end'   => ['required', 'date'],
            'image'      => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ];

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                $rules['title'] = 'required|unique:promos,slug,' . $this->route('promos'); // 'blog' is the Route Parameter
                break;
        }

        return $rules;
    }
}
