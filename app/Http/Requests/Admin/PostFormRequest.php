<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // false changed to true by mohssine
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id'       => ['required', 'integer'],
            'title'             => ['required', 'string'],
            'content'           => ['required', 'string'],
            'slug'              => ['required', 'string'],
            'meta_keyword'      => ['nullable', 'string'],
            'image'             => ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'meta_description'  => ['nullable', 'string'],
            'status'            => ['required'],
            'tag'               => ['required'],
        ];

        return $rules;
    }
}
