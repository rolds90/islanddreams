<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title'      => ['required', 'string', 'max:255', 'unique:news'],
            'news_date'  => ['required', 'date'],
            'publish_at' => 'nullable',
            'image'      => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ];

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                $rules['title'] = 'required|unique:news,slug,' . $this->route('news'); // 'blog' is the Route Parameter
                break;
        }

        return $rules;
    }
}
